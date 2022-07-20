<?php
    $widget = new Render("widgets/", "php");
    $widget->prop("api-auth");

    $validation = ["ch_key"];

    $response   = new Response("channel/create");
    $session    = new Session();
    $channel    = new Channel();

    if(multiple_isset($validation)){

        $ch_key = req_var("ch_key");

        $channel_exists = $channel->fetch_by_key($ch_key);
        $creation = $session->create($ch_key);

        if($creation && $channel_exists !== false){
            $response->message($creation);
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
?>