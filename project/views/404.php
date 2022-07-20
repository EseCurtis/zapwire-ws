<?php
    global $app;

    $render = new Render("", "php");
    $auth_page = new Render("auth", "php");

    $auth_page->prop("header", ["sub_title" => "Nothing Found"]);
    $render->prop("404");
    $auth_page->prop("footer");
    
?>