<?php
    
    $validation = ["subject", "content", "user_ids"];

    $response   = new Response("admin/message");
    $user       = new User();

    $user_not_exist = false;

    if(multiple_isset($validation)){

        $subject = req_var("subject");
        $content = req_var("content");
        $user_id = req_var("user_ids");

        
        $user_id = rtrim($user_id, ",");

        $user_ids = $user_id !== '*' ? explode(",", $user_id) : $user_id;

        $report = new Report();
        $report_status = $report->message($subject, $content, $user_ids);

        if($report_status) {
            $response->message("11");
        } else {
            $response->message("1");
        }

        
    }else{
        $response->message("0");
    }

    $response->print("json");
?>