<?php
    $widget = new Render("widgets/", "php");
    $widget->prop("api-auth");

    $validation = ["session_token"];

    $response   = new Response("session/create");
    $session    = new Session();

    if(multiple_isset($validation)){

        $session_token = req_var("session_token");

        $channel_path = $session->fetch_channel($session_token);
        $response->message($channel_path);
    }else{
        $response->message("0");
    }

    $response->print("json");
?>