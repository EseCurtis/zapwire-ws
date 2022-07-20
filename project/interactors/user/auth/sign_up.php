<?php
    $render = new Render("", "php");
    
    $validation = ["email", "password", "repeat_password"];

    $response   = new Response("user/sign-up");
    $user       = new User();
    $authLink   = new AuthLink();

    if(multiple_isset($validation)){

        $email = req_var("email");
        $password = req_var("password");
        $repeat_password = req_var("repeat_password");

        if( $password !== $repeat_password ) {
            $response->message("E004");
        } else {
            $creation = $user->create($email, $password);

            if($creation == 1){
                $auth_token = $authLink->gen_activation_token($email);
                $mailing = $user->send_activation_email($email, $auth_token);

                if($mailing){
                    $response->message("11");
                } else {
                    $response->message("0");
                    $recently_created_user = $user->fetch_by_email($email);
                    $user->delete($recently_created_user['id']);
                }

            }else if($creation === "E001"){
                $response->message("E001");
    
            } else if($creation === "E002"){
                $response->message("E002");
    
            } else if($creation === "E003"){
                $response->message("E003");
            } else {
                $response->message("1");
            }
        } 
    }else{
        $response->message("0");
    }

    $response->print("json");
?>