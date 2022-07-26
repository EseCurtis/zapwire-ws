<?php
    $user = new User();

    switch ($_data['is_auth_page']) {
        case false:

            if (!$user->logged_in_user_is_activated()) {
                header("Location: ".$app->url('dashboard/activation-notice'));
                exit;
            }
        
            if(!$user->is_loggedin()) {
                header("Location: ".$app->url('logout'));
                exit;

            }

            if($user->logged_in_user_is_deactivated()) {
                header("Location: ".$app->url('dashboard/disabled-notice'));
                exit;
            }

        break;

        case true:
            $user->is_loggedin() ? header("Location: ".$app->url('dashboard')) : null;
        break;
    }
?>