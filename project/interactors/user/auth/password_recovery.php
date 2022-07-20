<?php
    $render = new Render("", "php");
    
    $validation = ["email"];

    $response   = new Response("user/password-recovery");
    $user       = new User();
    $authLink   = new AuthLink();

    if(multiple_isset($validation)){

        $email = req_var("email");

        if($user->user_exists_by_email($email)) {
            if($user->isEmail($email)){
                $recovery_token = $authLink->gen_recovery_token($email);
    
                if($recovery_token){
                    $mailing = $user->send_recovery_email($email, $recovery_token);

                    if($mailing){
                        $response->message("12");
                    } else {
                        $response->message("11");
                    }
                } else {
                    $response->message("E001");
                }
            } else {
                $response->message("E002");
            }
        } else {
            $response->message("E003");
        }
        
    }else{
        $response->message("0");
    }

    $response->print("json");
?>