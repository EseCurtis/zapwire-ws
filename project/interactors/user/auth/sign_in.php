<?php
    
    $validation = ["email", "password"];

    $response   = new Response("user/sign-in");
    $user       = new User();

    $user_not_exist = false;

    if(multiple_isset($validation)){

        $email = req_var("email");
        $password = req_var("password");

        $user_validation = $user->fetch($email, $password);

        if($user_validation === "E001") {
            $response->message("E001");
            $user_not_exist = true;
        }
       
        if($user_validation || $user_not_exist){
            $user_data = $user->fetch($email, $password);
            
            session_start();

            $_SESSION["email"]  = $email;
            $_SESSION["password"] = $password;
            $_SESSION["user_id"] = $user_data["id"];

            $logged_in = $user->is_loggedin();
            $is_admin = $user->logged_in_user_is_admin();

            if($logged_in) {
                if($is_admin) {
                    $response->message("IA");
                } else {
                    $response->message("11");
                }
            } else {
                $response->message("1");
            }
        }else{
            $response->message("1");
        }
    }else{
        $response->message("0");
    }

    $response->print("json");
?>