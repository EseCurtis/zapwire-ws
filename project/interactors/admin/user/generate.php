<?php
    
    $validation = ["user_datas"];

    $response   = new Response("admin/user/generate");
    $user       = new User();

    $done = [];
    $failed = [];

    if(multiple_isset($validation)){
        $user_datas = req_var("user_datas");
        $user_datas = explode(",", $user_datas);

        foreach ($user_datas as $user_data) {
            $user_data = @json_decode($user_data, true);
            $darkmode = $user_data['darkmode'] ?? 0;
            $activated = $user_data['activated'] ?? 0;
            $email = $user_data['email'] ?? 0;
            $password = $email . rand(1000, 9999);
            $message = ["email" => $email];

            if($user->create($email, $password, $darkmode, $activated)){
                $user->send_welcome_email($email, $password);
                array_push($done, $message);
            } else {
                array_push($failed, $message);
            }
        }

        if(count($done) > 0){
            $response->message("11");
        } else {
            if(count($failed) > 0) {
                $response->message("1");
            } else {
                $response->message("0");
            }
        }

        $response->message(["done" => $done, "failed" => $failed]);

    }else{
        $response->message("0");
    }

    $response->print("json");
?>