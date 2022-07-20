<?php
    $render = new Render("", "php");
    $response   = new Response("user/resend-activation-link");
    $user = new User();

    if($user->send_activation_email_if_last_activation_link_request_is_due()) {
        $response->message("1");
    } else {
        $response->message("0");
    }

    $response->print("json");
?>