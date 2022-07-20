<?php
    global $app;

    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");

    $channel = new Channel();
    
    $widget->prop("auth");
    $render->prop("header", [
        "title" => "Channel Logs",
        "current_page" => "ch_logs",
    ]);

    $render->prop("channels/logs");
    
    $widget->prop("reload");
    $render->prop("footer");
?>
