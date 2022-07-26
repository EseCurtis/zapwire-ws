<?php
    $user = new User();
    $auth_link = new AuthLink();
    $render = new Render('', 'php');
    $activation_token = req_var('a_tkn');

    if(empty($activation_token)){
        $render->view('404');
    }

    

    $token_data = $auth_link->validate_activation_token($activation_token);
    

    if($token_data){
        
        $activation = $user->activate($token_data['user_id']);
        
        $auth_link->delete_auth_link_by_id($token_data['id']);
        $current_user = $user->fetch_by_id($token_data['user_id']);

        $_SESSION["email"]  = $current_user['email'];
        $_SESSION["password"] = $current_user['password'];
        $_SESSION["user_id"] = $current_user["id"];

        if($activation) {
            $render->view('auth/activation_success');
        } else {
            $render->view('auth/activation_failed');
        }
    } else {
        $render->view('auth/activation_failed');
    }
?>