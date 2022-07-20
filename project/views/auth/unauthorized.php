<?php
    global $app;

    $render = new Render("", "php");
    $auth_page = new Render("auth", "php");

    $auth_page->prop("header", ["sub_title" => "Restricted Access"]);
    $render->prop("unauthorized");
    $auth_page->prop("footer");
    
?>