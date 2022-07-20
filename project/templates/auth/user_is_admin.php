<?php
    $user = new User();
    $response = new Response("user/is_admin");

    if($user->logged_in_user_is_admin()) {
        $response->message('1');
    } else {
        $response->message('0');
    }

    $response->print('json');
?>
    
