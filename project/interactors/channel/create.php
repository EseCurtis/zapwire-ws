<?php
    
    $validation = ["path"];

    $response   = new Response("channel/create");
    $channel       = new Channel();

    if(multiple_isset($validation)){

        $path = req_var("path");
        $authorized_hostnames = req_var("authorized_hostnames");
        $headers = req_var("headers");

        $creation = $channel->create($path, $authorized_hostnames, $headers);

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