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

    //for escaping string when database is connected.
    function esc_str($value, $_db_){
        if(@mysqli_real_escape_string($_db_, trim($value))){
            return mysqli_real_escape_string($_db_, trim($value));
        }else{
            return trim($value);
        }
    }


    function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
        //whether ip is from the remote address  
        else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
    } 

    //for sanitizing url.
    function sanitize_url($url){
        $url = trim($url, "/");
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    //for including json files as arrays.
    function include_json($url){
        return json_decode(file_get_contents($url), TRUE);
    }

    //for hybrid hashing.
    function md52($str){
        return md5((bin2hex(md5($str))*bin2hex(md5($str)))/50);
    }

    //for getting request variables.
    function req_var($request_key, $_db_ = null){
        if(!$_db_){
            return (str_replace("\\", "", ($_REQUEST[$request_key])));
        }else{
            return htmlspecialchars(str_replace("\\", "", esc_str($_REQUEST[$request_key], $_db_)));
        }
        
    }

    //for  making easy sql queries.
    function db_query($query_script, $_db_){
        return mysqli_query($_db_, $query_script);
    }

    //for validating request variables.
    function multiple_isset($request_keys){
        $is_set = 0;
        foreach ($request_keys as $key => $value) {
            if(req_var($value)){
                $is_set++;
            }
        }
        if($is_set == count($request_keys)){
            return 1;
        }
        return 0;
    }

    //for escaping a string to become a valid url value.
    function special_escape($str){
        $str = preg_replace('~[^\\pL0-9_]+~u', '_', $str);
        $str = trim($str, '-');
        $str = iconv("utf-8", "us-ascii//TRANSLIT", $str);
        $str = strtolower($str);
        $str = preg_replace('~[^-a-z0-9_]+~', '', $str);
        return $str;
    }

    //for adding php code.
    function add_code($path){
        include _PATH_."/$path";
    }

    //for catching errors.
    function error_catch($func, $error = null){
        echo !$func ? $error: "";
    }

    function json_format($json_code){
        $json_code = str_replace("{","{\n", $json_code);
        $json_code = str_replace("}","}\n", $json_code);
        $json_code = str_replace("[","[\n", $json_code);
        $json_code = str_replace(",",",\n", $json_code);

        return($json_code);
    }

    function temp_lice($string){
        $string = explode("$", $string);
        for ($i=0; $i < count($string); $i++) { 
            $string_item = $string[$i];
            if($string_item[0] == "|" && $string_item[strlen($string_item)-1] == "|"){
                $string_item = str_replace("|", "", $string_item);
                $string_item = constant($string_item);    
                $string[$i] = $string_item;
            }
        }
        $string = implode("", $string);

        return $string;
    }

    function send_request($url){
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, "$url");

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch); 

        return $output;
    }

    function new_token () {
        return sha1(mt_rand(1, 90000) . 'SALT');
    }

    function embed_js($js) {
        echo "<script>$js</script>";
    }

    function generate_breadcrumb($title){
        $url = explode("/", $_SERVER['REQUEST_URI']);
        $title = explode("/", $_SERVER['REQUEST_URI']);
        $breadcrumb = "";
        for ($i=1; $i < count($url); $i++) { 
            $title[$i] = ucfirst($title[$i]);
            if($i == 1) {
                $breadcrumb .= '<li class="breadcrumb-item"><a href="'.$url[$i].'" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>';
            }else if($i == count($url)-1){
                $breadcrumb .= '<li class="breadcrumb-item active" aria-current="page">'.$title[$i].'</li>';
            }else{
                $breadcrumb .= '<li class="breadcrumb-item active" aria-current="page" href="'.$url[$i].'">'.$title[$i].'</li>';
            }
        }
        return $breadcrumb;
    
    }

    function validate_json($str=NULL) {
        if (is_string($str)) {
            @json_decode($str);
            return (json_last_error() === JSON_ERROR_NONE);
        }
        return false;
    }

    function get_vault_file($file_name){
        $file_path = _PATH_."/vault/".$file_name;
        
        if(file_exists($file_path)){
            return file_get_contents($file_path);
        }
        return false;
    }
?>