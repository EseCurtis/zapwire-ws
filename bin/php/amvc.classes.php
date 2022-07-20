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

    $content_dir = (__DIR__)."/../../project/";
    
    class Controller
    {
        private $controller_type, $controller_key, $current_view;

        //initialising controller data
        function __construct($controller_data)
        {
            $this->controller_type = $controller_data["type"];
            $this->controller_key  = $controller_data["key"];
            $this->current_view    = @$controller_data["view"];
        }

        //setting up interactors
        private function interact(){
            global $content_dir;
            error_catch(@include $content_dir."/interactors\/".$this->controller_key, "<b>Error:</b> The source file ($this->controller_key) for the api_key ($this->controller_key) is not found found in the interactors directory");
        }
        //setting up props
        private function render_prop(){
            global $content_dir;
            error_catch(@include $content_dir."/props\/".$this->controller_key, "<b>Error:</b> The source file ($this->controller_key) for the prop ($this->controller_key) is not found in the props directory");
        }
        //setting up views
        private function render_view(){
            global $content_dir;
            error_catch(@include $content_dir."/views\/".$this->controller_key, "<b>Error:</b> The source file ($this->controller_key) for the view ($this->current_view) is not found found in the views directory"); 
        }
        //setting up reserved
        private function render_reserved(){
            global $content_dir;
            include $content_dir."/../src/reserved\/".$this->controller_key;
        }

        //setting up execution
        function execute()
        {
            switch($this->controller_type){
                case "interactor":
                    $this->interact();
                break;
                case "prop":
                    $this->render_prop();
                break;
                case "view":
                    $this->render_view();
                break;
                case "reserved":
                    $this->render_reserved();
                break;
            }
        }
    }

    class Render {
        private $relative_path, $file_type;

        //initializing the relative path and file type for render context
        function __construct($relative_path = "/", $file_type = null)
        {
            $this->relative_path = $relative_path;
            $this->file_type = $file_type ? ".$file_type" : null;
        }

        static function requireToVar($file, $_data){
            ob_start();
            require($file);
            return ob_get_clean();
        }

        //rendering views
        function view($_key, $_data = null)
        {
            global $content_dir, $app;
            $current_render = $content_dir."/views/$this->relative_path/$_key$this->file_type";
            include $current_render;
        }

       //rendering props
        function prop($_key, $_data = null)
        {
            global $content_dir, $app;
            $current_render = $content_dir."/props/$this->relative_path/$_key$this->file_type";
            include $current_render;
        }

        //rendering interactors
        function interactor($_key, $_data = null)
        {
            global $content_dir, $app;
            $current_render = $content_dir."/interactors/$this->relative_path/$_key$this->file_type";
            include $current_render;
        }

        function template($_key, $_data = null)
        {
            global $content_dir, $app;
            $current_render = $content_dir."/templates/$this->relative_path/$_key$this->file_type";
            $test = $this->requireToVar($current_render, $_data);

            return $test;
        }
    }

    //for handling/controlling apis in amvc
    class Api_controller
    {
        private $api_command, $api_data_1, $api_data_2;

        //intializing api data
        function __construct()
        {   
            $api_request = (array) json_decode(req_var("_amvc_request_"));
            @$this->api_command = @$api_request["command"];
            @$this->api_data_1  = @$api_request["data_1"];
            @$this->api_data_2  = @$api_request["data_2"];  
        }

        //check api data errors
        private function check_errors()
        {
            if(empty(@$this->api_command)){
                echo "no command specified!";
            }
        }

        //process request
        private function process_request()
        {
            switch($this->api_command){
                #interactor
                    case '_interaction':
                        $controller_data = [
                            "type" => "interactor",
                            "key"  => $this->api_data_1
                        ];
                        $controller = new Controller($controller_data);
                        $controller->execute();
                    break;
                }
        }

        //execute processed request
        function execute()
        {
            $this->check_errors();
            $this->process_request();
        }
    }

    //for creating DOM elements
    class DOM
    {
        //for creating script tags
        function script_tag($src = null, $script = null)
        {
            global $dom_globals;
            $nl  = $dom_globals["newline"];
            $src = $src ? ' src="'.$src.'"' : "";

            $script_tag = "<script$src>$script</script>$nl";
            return $script_tag;
        }

        //for creating style tags
        function style_tag($src = null, $style = null)
        {
            global $dom_globals;
            $nl  = $dom_globals["newline"];

            if($src){
                $style_tag = "<link rel=\"stylesheet\" href=\"$src\">$nl";
            }else{
                $style_tag = "<style>$nl $style $nl</style>$nl";
            }
            return $style_tag;
        }
    }

    //for handling file operations
    class FileUpload{
        private 
            $uploads_path = (__DIR__)."/../../src/uploads",
            $current_file,
            $errors = [],
            $messages = []
        ;

        public 
            $file_size_limit,
            $uploadto_path = "",
            $valid_formats = [],
            $file_to_upload,
            $overwrite
        ;

        function __construct($file_to_upload){
            $this->file_to_upload = $file_to_upload;
        }

        private function upload(){

            mkdir($this->uploads_path."/".$this->uploadto_path."/");
            $this->current_file = ($this->uploads_path."/".$this->uploadto_path."/".basename($this->file_to_upload["name"]));
            $ready_to_upload    = 1;
            $file_format        = strtolower(pathinfo($this->current_file, PATHINFO_EXTENSION));

            

            if($this->file_size_limit){
                if($this->file_to_upload["size"] > $this->file_size_limit){
                    array_push($this->errors, "sorry file size too large! (".$this->file_to_upload["size"].")");
                    $ready_to_upload = 0;
                }else{
                    $ready_to_upload = 1;
                }
            }

            // Check if file already exists
            if (file_exists($this->current_file) && !$this->overwrite) {
                array_push($this->errors, "Sorry, file already exists.");
                $ready_to_upload = 0;
            }else{
                $ready_to_upload = 1;
            }
            if(!empty($this->valid_formats)){

                $formats_pass = 0;
                foreach ($this->valid_formats as $valid_format) {
                    if($file_format == $valid_format){
                        $formats_pass .= 1;
                    }
                }
                if($formats_pass == 0){
                    array_push($this->errors, "The file format is not supported");
                }
                $ready_to_upload = $formats_pass;

            }

            // Check if $uploadOk is set to 0 by an error
            if ($ready_to_upload == 0) {
                array_push($this->errors, "Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($this->file_to_upload["tmp_name"], $this->current_file)) {
                    array_push($this->messages, "The file ". htmlspecialchars( basename( $this->file_to_upload["name"])). " has been uploaded.");
                } else {
                    array_push($this->errors, "Sorry, there was an error uploading your file.");
                }
            }
        }

        public function execute(){
            $this->upload();
            return [
                "messages" => $this->messages,
                "errors"=> $this->errors,
                "upload_path"=> $this->current_file
            ];
        }
    }


    //for handling a more arranged response to api requests
    class Response{
        private $route, $messages = [], $errors = [], $response_code;

        function __construct($route){
            $this->route = $route;
        }

        function message($message){
            array_push($this->messages, $message);
        }

        function set_message($message){
            $this->messages = $message;
        }
        function error($error){
            array_push($this->errors, $error);
        }
        function response_code($code){
            $this->response_code = $code;
        }

        function print($method){
            $response_data = [
                "route"=>$this->route, 
                "message"=>$this->messages,
                "errors"=>$this->errors,
                "response_code"=>$this->response_code,
            ];

            switch($method){
                case "json":
                    return print json_encode($response_data);
                break;
                default:
                    return $response_data;
                break;
            }
        }
    }
?>