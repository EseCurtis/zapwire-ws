<?php
    
    $validation = ["currentPassword", "newPassword", "confirmPassword"];

    $response   = new Response("settings/change_password");
    $settings       = new Settings();

    $user_not_exist = false;

    if(multiple_isset($validation)){

        $currentPassword = req_var("currentPassword");
        $newPassword = req_var("newPassword");
        $confirmPassword = req_var("confirmPassword");

        $password_update = $settings->change_password($currentPassword, $newPassword, $confirmPassword);

        $response->message($password_update);
    }else{
        $response->message("0");
    }

    $response->print("json");
?>