<?php
    
    $validation = ["email", "password"];

    $response   = new Response("admin/user/new");
    $user       = new User();

    if(multiple_isset($validation)){

        $email = req_var("email");
        $password = req_var("password");

        if($user->create($email, $password)){
            $response->message("11");
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
?>