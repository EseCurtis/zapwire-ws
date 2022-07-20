<?php
    
    $validation = ["ch_id", "req_from", "user_id", "status", "message"];

    $response   = new Response("channel/create");
    $log       = new Log();

    if(multiple_isset($validation)){

        $id = req_var("ch_id");
        $from = req_var("req_from");
        $ref_id = req_var("user_id");
        $status = req_var("status");
        $message = req_var("message");

        $creation = $log->write($id, $from, $ref_id, $status, $message);

        if($creation == 1){
            $response->message("11");
        
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
?>