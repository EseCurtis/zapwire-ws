<?php
    global $app;

    $render = new Render("auth", "php");
    $auth_page = new Render("auth/pages", "php");
    $widget = new Render("widgets", "php");

    $widget->prop("auth", ['is_auth_page' => true]);

    $render->prop("header", ["sub_title" => "Admin sign-in"]);
    $auth_page->prop("sign_in.admin");
    $render->prop("footer");
    
?>