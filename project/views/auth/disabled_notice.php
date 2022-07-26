<?php
    global $app;

    $render = new Render("auth", "php");
    $auth_page = new Render("auth/pages", "php");
    $widget = new Render("widgets", "php");
    $user = new User();

    $logged_in_user = $user->get_loggedin_user();

    if ($logged_in_user['deactivated'] == 0) {
        header("Location: ".$app->url('dashboard'));
        exit;
    }

    $render->prop("header", ["sub_title" => "Disabled Notice"]);
    $auth_page->prop("disabled_notice");
    $render->prop("footer");
    
?>