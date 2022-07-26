<?php
    global $app;
    $render = new Render("admin", "php");
    $page = new Render("pages/", "php");
    $widget = new Render("widgets/", "php");

    $widget->prop("auth");

    $render->prop("header", [
        "title" => "Generate Users",
    ]);

    $render->prop("users/generate");

    $render->prop("footer", [
        "page_script" => "
            
        ",
    ]);
?>
