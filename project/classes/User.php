<?php
    class User {
        function create($email, $password) {
            global $app;

            if(!$this->isEmail($email)) {
                return "E003";
            }

            if(!$this->validPassword($password)) {
                return "E002";
            }

            $password = md52($password);

            $CreateAvatar = new CreateAvatar();
            $user_avatar = $CreateAvatar->base64("test");

            $validate_credentials_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE email='$email'");
            $validate_credentials_result = mysqli_fetch_assoc($validate_credentials_query);

            if($validate_credentials_result) {
                return "E001";
            }

            $create_query = mysqli_query($app->_db_, "INSERT INTO `zw_users` (`id`, `email`, `password`, `avatar`, `deactivated`, `is_activated`, `have_logged_in`, `darkmode`) VALUES (NULL, '$email', '$password', '$user_avatar', 1, 0, 0, 0)");

            if($create_query){
                return 1;
            }

            return 0;
        }

        function auth($id, $password) {
            global $app;

            $password = md52($password);

            $validate_credentials_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE id='$id' AND password='$password'");
            $validate_credentials_result = mysqli_fetch_assoc($validate_credentials_query);

            if($validate_credentials_result) {
                return 1;
            }

            return 0;
        }

        function isEmail($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        function validPassword($password) {
            return strlen($password) >= 6;
        }


        function fetch($email, $password) {
            global $app;

            $password = md52($password);

            $validate_credentials_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE email='$email' AND password='$password'");
            $validate_credentials_result = mysqli_fetch_assoc($validate_credentials_query);

            if($validate_credentials_result) {
                return $validate_credentials_result;
            }

            return false;
        }

        function fetch_by_email($email) {
            global $app;

            $validate_credentials_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE email='$email'");
            $validate_credentials_result = mysqli_fetch_assoc($validate_credentials_query);

            if($validate_credentials_result) {
                return $validate_credentials_result;
            }

            return false;
        }
        
        function user_exists_by_email($email) {
            global $app;

            $validate_credentials_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE email='$email'");
            $validate_credentials_result = mysqli_fetch_assoc($validate_credentials_query);

            if($validate_credentials_result) {
                return true;
            }

            return false;
        }

        function is_loggedin (){

            if($this->get_loggedin_user()){
                return true;
            }

            return false;
        }

        function get_loggedin_user () {
            if(!$_SESSION){
                session_start();
            }

            if(isset($_SESSION['email']) && isset($_SESSION['password'])){
                return $this->fetch($_SESSION['email'], $_SESSION['password']);
            }

            return 0;
        }

        function fetch_by_id($id){
            global $app;
            
            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE id='$id'");
            $fetched_data = mysqli_fetch_array($fetch_query);

            if($fetched_data){
               
                return $fetched_data;
            }

            return 0;
        }

        function fetch_all(){
            global $app;
            
            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users`");
            $fetched_data = mysqli_fetch_all($fetch_query, MYSQLI_ASSOC);

            if($fetched_data){
                return $fetched_data;
            }

            return 0;
        }

        function active($id, $status = 1) {
            global $app;

            $active_query = mysqli_query($app->_db_, "UPDATE `zw_users` SET `is_activated`='$status' WHERE `id`='$id'");

            if($active_query){
                return 1;
            }
        }

        function set_logged_in ($id, $value = 1) {
            global $app;

            $alter_query = mysqli_query($app->_db_, "UPDATE `zw_users` SET `have_logged_in`='$value' WHERE `id`='$id'");

            if($alter_query){
                return 1;
            }
        }

        function have_logged_in ($id) {
            global $app;

            $have_logged_in_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE `id`='$id' AND `have_logged_in`='1'");
            $have_logged_in_result = mysqli_fetch_assoc($have_logged_in_query);

            if($have_logged_in_result){
                return true;
            }

            return false;

        }

        function get_logged_in_user_darkmode_status(){
            global $app;

            $darkmode_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE `id`='".$this->get_loggedin_user()['id']."'");
            $darkmode_result = mysqli_fetch_assoc($darkmode_query);

            if($darkmode_result){
                return $darkmode_result['darkmode'] == 1 ? '1' : '0';
            }

            return '0';
        }

        function get_logged_in_user_profile_image(){
            global $app;

            $profile_image_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE `id`='".$this->get_loggedin_user()['id']."'");
            $profile_image_result = mysqli_fetch_assoc($profile_image_query);

            if($profile_image_result){
                return $profile_image_result['avatar'];
            }

            return '0';
        }

        function logged_in_user_is_deactivated() {
            global $app;

            $deactivated_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE `id`='".$this->get_loggedin_user()['id']."'");
            $deactivated_result = mysqli_fetch_assoc($deactivated_query);

            if($deactivated_result){
                
                return $deactivated_result['deactivated'];
            }

            return false;

        }

        function logged_in_user_is_admin() {
            global $app;

            $user = $this->get_loggedin_user();

            if($user){
                return $user['type'] == '1' ? true : false;
            }

            return false;

        } 

        function logged_in_user_is_activated() {
           
            $user = $this->get_loggedin_user();

            if($user['is_activated'] === '1') {
                return true;
            }

            return false;

        }

        //deactivate user
        function deactivate($id) {
            global $app;

            $deactivate_query = mysqli_query($app->_db_, "UPDATE `zw_users` SET `deactivated`='1' WHERE `id`='$id'");

            if($deactivate_query){
                return 1;
            }
        }

        //activate user
        function activate($id) {
            global $app;

            $activate_query = mysqli_query($app->_db_, "UPDATE `zw_users` SET `is_activated`='1' WHERE `id`='$id'");

            if($activate_query){
                return 1;
            }
        }

        //recover_password
        function recover_password_update($token, $new_password) {
            global $app;

            $authLink = new AuthLink();
            $user_id = @$authLink->validate_recovery_token($token)['user_id'];
            $new_password = md52($new_password);

            if($user_id) {
                $recover_password_query = mysqli_query($app->_db_, "UPDATE `zw_users` SET `password`='$new_password' WHERE `id`='$user_id'");

                if($recover_password_query){
                    $authLink->delete_recovery_token($token);
                    return 1;
                } else {
                    return 'E001';
                }
            } else {
                return 'E002';
            }
        }

        function send_recovery_email($user_email, $token) {
            global $app;

            $render = new Render('', 'php');
            $mail   =  $render->template('recovery', ['token' => $token, 'user_email' => $user_email]);

            $sendgrid_mail = new SendGrid_Mail();
            $response = $sendgrid_mail->send($app->project_info['noreply_email'], $user_email, 'Password Recovery.', $mail, 'text/html', 'Zapwire Support');

            return $response;
        }

        //send activation email
        function send_activation_email($user_email, $token) {
            global $app;

            $render = new Render('', 'php');
            $mail   =  $render->template('activation', ['token' => $token, 'user_email' => $user_email]);

            $sendgrid_mail = new SendGrid_Mail();
            $response = $sendgrid_mail->send($app->project_info['noreply_email'], $user_email, 'Account Activation.', $mail, 'text/html', 'Zapwire');

            return $response;
        }

        function delete($id) {
            global $app;

            $delete_query = mysqli_query($app->_db_, "DELETE FROM `zw_users` WHERE `id`='$id'");

            if($delete_query){
                return 1;
            }
        }

        //function for time_ago

        function time_ago($time) {
            $time_ago = strtotime($time);
            $current_time = time();
            $time_difference = $current_time - $time_ago;
            $seconds = $time_difference;
            $minutes = round($seconds / 60);
            $hours = round($seconds / 3600);
            $days = round($seconds / 86400);
            $weeks = round($seconds / 604800);
            $months = round($seconds / 2629440);
            $years = round($seconds / 31553280);

            if($seconds <= 60) {
                return "Just now";
            } else if($minutes <= 60) {
                if($minutes == 1) {
                    return "one minute ago";
                } else {
                    return "$minutes minutes ago";
                }
            } else if($hours <= 24) {
                if($hours == 1) {
                    return "an hour ago";
                } else {
                    return "$hours hours ago";
                }
            } else if($days <= 7) {
                if($days == 1) {
                    return "yesterday";
                } else {
                    return "$days days ago";
                }
            } else if($weeks <= 4.3) {
                if($weeks == 1) {
                    return "a week ago";
                } else {
                    return "$weeks weeks ago";
                }
            } else if($months <= 12) {
                if($months == 1) {
                    return "a month ago";
                } else {
                    return "$months months ago";
                }
            } else {
                if($years == 1) {
                    return "one year ago";
                } else {
                    return "$years years ago";
                }
            }
        }

        function logged_in_user_last_activation_link_request() {
            global $app;

            $user_id = $this->get_loggedin_user()['id'];
            $last_activation_link_request_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE `id`='$user_id'");
            $last_activation_link_request_result = mysqli_fetch_assoc($last_activation_link_request_query);

            if($last_activation_link_request_result){
                return $last_activation_link_request_result['last_activation_link_request'];
            }

            return false;
        }

        //function to get last activation link request time in specified format (e.g. 1 hour ago)
        function get_last_activation_link_request_time_ago() {
            global $app;

            $user_id = $this->get_loggedin_user()['id'];
            $last_activation_link_request_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE `id`='$user_id'");
            $last_activation_link_request_result = mysqli_fetch_assoc($last_activation_link_request_query);

            if($last_activation_link_request_result){
                return $this->time_ago($last_activation_link_request_result['last_activation_link_request']);
            }

            return false;
        }

        function update_last_activation_link_request($id) {
            global $app;

            $update_last_activation_link_request_query = mysqli_query($app->_db_, "UPDATE `zw_users` SET `last_activation_link_request`= current_timestamp() WHERE `id`='$id'");

            if($update_last_activation_link_request_query){
                return 1;
            }
        }

        //send activation email to user if last activation link request is more than due
        function send_activation_email_if_last_activation_link_request_is_due() {
            global $app;

            $due_time_for_activation_link_request = $app->project_info['activation_link_request_due_time'];

            $user_id = $this->get_loggedin_user()['id'];
            $last_activation_link_request_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE `id`='$user_id'");
            $last_activation_link_request_result = mysqli_fetch_assoc($last_activation_link_request_query);

            if($last_activation_link_request_result){
                $last_activation_link_request_time = $last_activation_link_request_result['last_activation_link_request'];
                $last_activation_link_request_time_ago = $this->time_ago($last_activation_link_request_time);

                if($last_activation_link_request_time_ago > $due_time_for_activation_link_request){
                    $authLink = new AuthLink();
                    $auth_token = $authLink->gen_activation_token($last_activation_link_request_result['email']);
                   
                    $this->send_activation_email($last_activation_link_request_result['email'], $auth_token);

                    $this->update_last_activation_link_request($user_id);
                    
                    return true;
                }
            }

            return false;

        }

       

        function get_by_year($year = '*') {
            global $app;

            $get_by_year_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE YEAR(`date_created`)='$year'");
            $get_by_year_result = mysqli_fetch_all($get_by_year_query, MYSQLI_ASSOC);

            if($get_by_year_result){
                return $get_by_year_result;
            }
        }

        function send_mail ($user, $subject, $content, $from) {
            global $app; 

            $user_email = $user['email'];
            //source username from user_email
            $user_name = explode('@', $user_email);
            $user_name = $user_name[0];
        
            $render = new Render('', 'php');
            $mail   =  $render->template("message", ['username' => $user_name, 'user_email' => $user_email, $content => $content]);

            $sendgrid_mail = new SendGrid_Mail();
            return $sendgrid_mail->send($app->project_info['noreply_email'], $user_email, $subject , $mail, 'text/html', $from);
            
        }

        function mail( $subject, $content, $from = "Zappie from Zapwire :)", $user_id = '*') {
            if(@$user_id[0]) {
                $user_id = (array) $user_id;
                
                $user_id = array_unique($user_id);

                foreach ($user_id as $id) {
                    if($id == '*') {
                        return;
                    }
                    $user = $this->fetch_by_id($id);
                    $this->send_mail($user, $subject, $content, $from);
                }
            } else if ($user_id == '*') {
                foreach($this->fetch_all() as $user){
                    $this->send_mail($user, $subject, $content, $from);
                }
            } else {
                $user = $this->fetch_by_id($user_id);
                $this->send_mail($user, $subject, $content, $from);
            }
        }

        function get_logged_in_user_role() {
            global $app;
            $user_id = $this->get_loggedin_user()['id'];
            $get_logged_in_user_role_query = mysqli_query($app->_db_, "SELECT * FROM `zw_users` WHERE `id`='$user_id'");
            $get_logged_in_user_role_result = mysqli_fetch_assoc($get_logged_in_user_role_query);

            if($get_logged_in_user_role_result){
                return $get_logged_in_user_role_result['type'] == '1' ? 'Admin' : 'User';
            }
        }
         
    }
