<?php
    global $app;

    $username = str_split($_data['user_email'], strrpos($_data['user_email'], '@'))[0];
    $sign_in_url = $app->url('sign-in');

    $render = new Render('', 'php');

    $render->prop('mail/header', [
        "title" => 'Welcome to Zapwire!'
    ]);

    $render->prop('widgets/mail/text', [
        "value" => "Hurray $username!<br> Welcome to zapwire-ws.<br>the wait has finally ended<br>Sign-in and verify your account below", 
    ]);

    $render->prop('widgets/mail/text2', [
        "value" => "username: {$_data['user_email']}<br>password: {$_data['user_password']}<br>"
    ]);

    $render->prop('widgets/mail/button', [
        "value" => "Sign In",
        "url" => $sign_in_url
    ]);

    $render->prop('widgets/mail/fallback', [
        "value" => "If the above button is not functional you can use the following link:",
        "url" => $sign_in_url
    ]);

    $render->prop('mail/footer');
?>
