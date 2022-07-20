<?php
    class Settings {
        function set_darkmode($value = 1) {
            global $app;

            $user = new User();
            $user_id = $user->get_loggedin_user()['id'];

            $darkmode = mysqli_query($app->_db_, "UPDATE `zw_users` SET `darkmode` = '$value' WHERE `id` = '$user_id'");

            if ($darkmode) {
                return 1;
            } else {
                return 0;
            }
        }

        function get_darkmode() {
            
            $user = new User();
            $user_id = $user->get_loggedin_user()['id'];

        }

        function change_password($last_password, $new_password, $confirm_password) {
            global $app;

            $user = new User();
            $user_id = $user->get_loggedin_user()['id'];
            $is_authorized =  $user->auth($user_id, $last_password);

            if ($is_authorized) {
                if ($new_password == $confirm_password && $user->validPassword($new_password)) {
                    $new_password = md52($new_password);
                    $password_change = mysqli_query($app->_db_, "UPDATE `zw_users` SET `password` = '$new_password' WHERE `id` = '$user_id'");

                    if ($password_change) {
                        return 'S001';
                    } else {
                        return 'E001';
                    }
                } else if(!$user->validPassword($new_password))  {
                    return 'E002';
                } else {
                    return 'E003';
                }
            } else {
                return 'E004';
            }
        }

        function deactivate_account($reverse = false){
            global $app;

            $user = new User();
            $user_id = $user->get_loggedin_user()['id'];

            if ($reverse) {
                $deactivate = mysqli_query($app->_db_, "UPDATE `zw_users` SET `deactivated` = '0' WHERE `id` = '$user_id'");
            } else {
                $deactivate = mysqli_query($app->_db_, "UPDATE `zw_users` SET `deactivated` = '1' WHERE `id` = '$user_id'");
            }

            if ($deactivate) {
                return 'S001';
            } else {
                return 'E001';
            }
        }

        
    }
?>