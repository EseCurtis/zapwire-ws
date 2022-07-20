<?php
    $render = new Render("", "php");
    
    $validation = ["recovery_token", "password", "repeat_password"];

    $response   = new Response("user/password-reset");
    $user       = new User();
    $authLink   = new AuthLink();

    if(multiple_isset($validation)){

        $recovery_token = req_var("recovery_token");
        $password = req_var("password");
        $repeat_password = req_var("repeat_password");

        if($authLink->validate_recovery_token($recovery_token)){
            if( $password !== $repeat_password ) {
                $response->message("E003");
            } else if(! $user->validPassword($password) ) {
                $response->message("E004");
            } else {
                $creation = $user->recover_password_update($recovery_token, $password);
    
                if($creation == 1){
                    $response->message("11");
                } else {
                    $response->message($creation);
                }
            }
        } else {
            $response->message("E005");
        }
    }else{
        $response->message("0");
    }

    $response->print("json");
?>