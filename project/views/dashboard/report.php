<?php
    global $app;
    $render = new Render("dashboard", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");

    $user_id = req_var("u_id");

    $widget->prop("auth");
    $render->prop("header", [
        "title" => "Messages",
        "current_page" => "rprt",
    ]);
    
    $render->prop("report");
    $render->prop("footer");
?>
