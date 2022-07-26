<?php
    
    $validation = ["subject", "content"];

    $response   = new Response("user/report");
    $user       = new User();

    $user_not_exist = false;

    if(multiple_isset($validation)){

        $subject = req_var("subject");
        $content = req_var("content");
        $user_id = $user->get_loggedin_user()['id'];

        $report = new Report();
        $report_status = $report->send($subject, $content, $user_id);

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