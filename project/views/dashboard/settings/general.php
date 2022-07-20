<?php
    global $app;

    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");
    

    $widget->prop("auth");
    $render->prop("header", [
        "title" => "Settings",
        "current_page" => "settings",
    ]);
    $render->prop("settings/general");
    $widget->prop("reload");
    $render->prop("footer");
?>
