<?php
    $widget = new Render("widgets/", "php");
    $widget->prop("api-auth");

    $validation = ["session_token"];

    $response   = new Response("session/delete");
    $session     = new Session();

    if(multiple_isset($validation)){

        $session_token = req_var("session_token");

        $deletion = $session->delete($session_token);

        if($deletion == 1){
            $response->message("11");
        
        } else {
            $response->message("1");
        }

    }else{
        $response->message("0");
    }

    $response->print("json");
?>