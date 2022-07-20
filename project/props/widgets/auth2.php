<?php
    $user = new User();

    if(!$user->is_loggedin()) {
        header("Location: ".$app->url('logout'));
        exit;
    }

    if($user->logged_in_user_is_activated()) {
        header("Location: ".$app->url('dashboard'));
        exit;
    }