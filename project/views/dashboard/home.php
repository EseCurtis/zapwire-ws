<?php
    global $app;

    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");
    

    $widget->prop("auth");
    $render->prop("header", [
        "title" => "Dashboard",
        "current_page" => "",
    ]);
    $render->prop("overview");
    $render->prop("footer");
?>
