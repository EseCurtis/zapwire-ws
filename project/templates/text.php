<?php
    global $app;

    $token = $_data['token'];
    $username = str_split($_data['user_email'], strrpos($_data['user_email'], '@'))[0];

    $render = new Render('', 'php');

    $render->prop('mail/header', [
        "title" => $_data['subject']
    ]);


    $render->prop('widgets/mail/text', [
        "value" => "Hi $username!<br>", 
    ]);

    $render->prop('widgets/mail/text2', [
        "value" => $_data['content']
    ]);

    $render->prop('mail/footer');
?>
