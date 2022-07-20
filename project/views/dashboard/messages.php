<?php
    global $app;
    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");

    $message_id = req_var("m_id");

    $widget->prop("auth");
    $render->prop("header", [
        "title" => "Messages",
        "current_page" => "msgs",
    ]);

    if($message_id == "") {
        $render->prop("messages");
    } else {
        $render->prop("message", [
            "message_id" => $message_id,
        ]);
    }

    $render->prop("footer");
?>
