<?php
    $user = new User();
    $response = new Response("user/is_logged_in");

    if($user->is_loggedin()) {
        $response->message('1');
    } else {
        $response->message('0');
    }

    $response->print('json');
?>
    
