<?php
    global $app;

    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");
    

    $widget->prop("auth");
    $render->prop("header", [
        "title" => "Create Channel",
        "current_page" => "create_channel",
    ]);
    $render->prop("channels/create");
    $widget->prop("reload");
    $render->prop("footer");
?>
