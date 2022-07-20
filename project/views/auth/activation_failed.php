<?php
    global $app;

    $render = new Render("auth", "php");
    $auth_page = new Render("auth/pages", "php");
    $widget = new Render("widgets", "php");


    $render->prop("header", ["sub_title" => "Activation"]);
    $auth_page->prop("activation_failed");
    $render->prop("footer");
