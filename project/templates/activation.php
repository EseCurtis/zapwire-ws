<?php
    global $app;

    $token = $_data['token'];
    $username = str_split($_data['user_email'], strrpos($_data['user_email'], '@'))[0];
    $account_activation_url = $app->url('activation?a_tkn='.$token);
    $app_title = $app->project_info['title'];

    $render = new Render('', 'php');

    $render->prop('mail/header', [
        "title" => 'Account Activation: Use this link to activate your account',
    ]);

    $render->prop('widgets/mail/text', [
        "value" => "Hi $username,<br> Activate your account by clicking the below button"
    ]);

    $render->prop('widgets/mail/button', [
        "value" => "Activate Account",
        "url" => $account_activation_url
    ]);

    $render->prop('widgets/mail/text2', [
        "value" => "If you did not create a $app_title account, please ignore this email."
    ]);

    $render->prop('widgets/mail/fallback', [
        "value" => "If the above button is not functional you can use the following link:",
        "url" => $account_activation_url
    ]);

    $render->prop('mail/footer');
?>
