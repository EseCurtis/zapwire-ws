<?php
    global $app;

    $token = $_data['token'];
    $username = str_split($_data['user_email'], strrpos($_data['user_email'], '@'))[0];
    $password_reset_url = $app->url('password-reset?r_tkn='.$token);

    $render = new Render('', 'php');

    $render->prop('mail/header', [
        "title" => 'Password Recovery'
    ]);

    $render->prop('widgets/mail/text', [
        "value" => "Hi $username,<br> you can reset your password by clicking the below button"
    ]);

    $render->prop('widgets/mail/button', [
        "value" => "Reset Password",
        "url" => $password_reset_url
    ]);

    $render->prop('widgets/mail/text2', [
        "value" => "If you did not request a password reset, please ignore this email."
    ]);

    $render->prop('widgets/mail/fallback', [
        "value" => "If the above button is not functional you can use the following link:",
        "url" => $password_reset_url
    ]);

    $render->prop('mail/footer');
?>
