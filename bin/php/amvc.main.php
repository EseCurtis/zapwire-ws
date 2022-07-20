<?php
/**
 * AMVC
 *
 * A lightweight framework for working with multiple Inter APIs
 *
 *
 * Copyright (c) 2020 - 2021, Esecodes Tech
 *
 * Any owner of this copy of the AMVC package is licenced to make 
 * changes to code and to give feed back about any errors on the
 * package
 *
 *
 * @package	AMVC
 * @author	Ese Curtis .A.
 * @copyright	Copyright (c) 2020 - 2021, Ese Curtis .A.
 * @link	https://amvc-framework.netlify.com
 * @since	Version 1.2.0
 */

    include (__DIR__)."/amvc.classes.php";
    include (__DIR__)."/amvc.global.php";
    include (__DIR__)."/amvc.functions.php";

    class AMVC{

        public 
        $values, 
        $javascript_enabled,
        $stylesheet_enabled, 
        $database,
        $project_info,
        $_db_;

        private 
        $controller_type = "view", 
        $views,
        $live_channels, 
        $matched_view, 
        $current_view, 
        $previous_view,
        $request_url, 
        $website_url, 
        $compared_view, 
        $view_inheritance, 
        $value_count = 0;

        function __construct($amvc_configuration)
        {
            global $reserved;
            //declare the variables for executuion
            $this->request_url   = @$_REQUEST["url"] ? sanitize_url($_REQUEST["url"]) : "";
            $this->website_url   = temp_lice($amvc_configuration["website_url"]);
            $this->views         = (array) $amvc_configuration["views"];
            $this->live_channels = (array) $amvc_configuration["live_channels"];
            $this->database      = (array) $amvc_configuration["database"];
            $this->project_info  = (array) $amvc_configuration["project_info"];
            $this->reserved      = $reserved;

            //check if default amvc includes are enabled
            $this->javascript_enabled = $amvc_configuration["javascript_enabled"];
            $this->stylesheet_enabled = $amvc_configuration["stylesheet_enabled"];
            

            //preparing comparison values
            $this->values        = explode("/", trim($this->request_url));
            $this->compared_view = $this->values[0];

            
            $this->define_globals();
        }

        //insertion of js link to amvc.js
        public function insert_js()
        {
            if(@$this->javascript_enabled == true && @$this->controller_type !== "reserved"){                
                $dom = new DOM();
                echo $dom->script_tag(_URL_."/src/amvc.js");
            }
        }

        //insertion of css link to amvc.js
        public function insert_css()
        {
            if(@$this->stylesheet_enabled == true && @$this->controller_type !== "reserved"){                
                $dom = new DOM();
                echo $dom->style_tag(_URL_."/src/amvc.css");
            }
        }

        //connecting database
        public function connect_database()
        {
            if(!empty($this->database)){
                $this->_db_ = new mysqli($this->database['host'], $this->database['username'], $this->database['password'], $this->database['name']);
            }
        }

        //Checking if request url matches reserved links
        private function check_reserved(){
            foreach ($this->reserved as $reserve) {
                $reserve["source"] = "../".$reserve["source"];
            }
            if(@$this->compared_view == "src"){
                if(@$this->reserved[@$this->values[1]]){
                    $this->controller_type = "reserved"; 
                    $this->matched_view = @$this->reserved[@$this->values[1]];
                }  
            }
        }

        private function import_onloaded() {
            $dom = new DOM();
            echo $dom->script_tag(_URL_."/src/amvc.onloaded");
        }

        //defining global variables
        private function define_globals()
        {
            defined("_URL_") ? "" :define("_URL_", $this->website_url); 
        }

        public function get_channel($channel_id){
            if(@$this->live_channels[$channel_id]){
                return $this->live_channels[$channel_id];
            }
            return 0;
        }

        //comparison of request to views to see matches
        private function check_matched()
        {
            if(@$this->views[$this->compared_view])
            {
                //verify if the other part of request url is valid 
                $this->view_inheritance = (array) $this->views[$this->compared_view];

                if(@$this->view_inheritance["views"])
                {
                    $this->view_inheritance["views"] = (array) $this->view_inheritance["views"];
                    

                    //iteration through values (the other part of request url)
                    foreach ($this->values as $value)
                    {
                        if(@$this->values_count > 0){
                           
                            if($this->check_auth()){
                                return 0;
                            }
                            @$this->view_inheritance["views"] = (array) @$this->view_inheritance["views"];
                            if(@$this->view_inheritance["views"][$value])
                            {
                                $this->view_inheritance = (array) $this->view_inheritance["views"][$value];
                                
                            }else{
                                if(! @$this->view_inheritance["not_path"] == true) {
                                    $this->view_inheritance = (array) $this->views["404"];
                                }
                            }
                        }
                        $this->values_count = 1;
                    }
                }
            }else if(@$this->views[$this->views["init"]] && strlen($this->compared_view) < 1){
                $this->view_inheritance = $this->views[$this->views["init"]];
                $this->compared_view    = $this->views["init"];
            }

            if($this->check_auth()){
                return 0;
            }

            $this->matched_view = (array) $this->view_inheritance;
        }

        function check_auth () {
            if(@$this->view_inheritance["auth"][0]){
                $authentications = (array) $this->view_inheritance["auth"];
                
                foreach ($authentications as $authentication) {
                    if(@$authentication["pass"] && $authentication["redirect"]){
                        $render = new Render();
                        $auth_feedback = $render->template($authentication["pass"]);
        
                        if(@json_decode($auth_feedback)) {
                            $auth_feedback = json_decode($auth_feedback, true);
        
                            if($auth_feedback['message'][0] !== '1') {
                                $this->redirect(@$authentication["redirect"]);
                                return 1;
                            } else {
                                return 0;
                            }
                        } else {
                            die("$auth_feedback");

                        }
                    }
                }
            }
        }

        function redirect($view_source) {
            $this->matched_view = ["source" => $view_source];
        }

        function url($path) {
            return _URL_ . "/" . $path;
        }

        //to execute proccessed info
        function run()
        {

            //execute all neccessary functions
            $this->check_matched();
            $this->check_reserved();
            $this->insert_js();
            $this->insert_css();

            if(@$this->matched_view['source'] == ""){
                $this->matched_view = (array) $this->views["404"];
            }
            
            //loading the view
            $load_view = new Controller([
                "type"=>$this->controller_type, 
                "key"=>$this->matched_view["source"], 
                "view"=>$this->compared_view
            ]);

            $load_view->execute();

            if(@!$this->matched_view["content-type"]) {
                $this->matched_view["content-type"] = "text/html";
            }

            if($this->controller_type !== "reserved" && @$this->matched_view["content-type"] == "text/html"){
                $this->import_onloaded();
            }
        }
    }
?>