<?php
    global $app;

    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");
    

    $widget->prop("auth");
    $render->prop("header", [
        "title" => "Channels",
        "current_page" => "channels",
    ]);
    $render->prop("channels");
    $widget->prop("reload");
    $render->prop("footer");
?>
