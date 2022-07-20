<?php
    global $app;

    $render = new Render("auth", "php");
    $auth_page = new Render("auth/pages", "php");
    $widget = new Render("widgets", "php");

    $widget->prop("auth", ['is_auth_page' => true]);

    $authLink = new AuthLink();

    $recovery_token = req_var("r_tkn");
    $verify_token = $authLink->validate_recovery_token($recovery_token);

    if(!($verify_token)){
       header('Location: '.$app->url('sign-in'));
    }

    $render->prop("header", ["sub_title" => "Password-reset"]);
    $auth_page->prop("password_reset", ["token" => $recovery_token]);
    $render->prop("footer");
