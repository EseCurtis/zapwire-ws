<?php
    
    $validation = ["subject", "content", "user_ids", "from"];

    $response   = new Response("admin/mail");
    $user       = new User();

    $user_not_exist = false;

    if(multiple_isset($validation)){

        $subject = req_var("subject");
        $content = req_var("content");
        $user_id = req_var("user_ids");
        $from = req_var("from");

        $user_id = rtrim($user_id, ",");
        $user_ids = $user_id !== '*' ? explode(",", $user_id) : $user_id;

        $user = new User();
        $mail_status = $user->mail($subject, $content, $from, $user_ids);

        if($mail_status) {
            $response->message("11");
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
