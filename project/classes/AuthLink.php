<?php
    class AuthLink {
        function fetch_all() {
            $auth_link = new AuthLink();
            $auth_links = $auth_link->read_all();

            return $auth_links;
        }

        function read_all() {
            global $app;

            $auth_link_query = mysqli_query($app->_db_, "SELECT * FROM `zw_auth_links`");
            $auth_link_result = mysqli_fetch_all($auth_link_query, MYSQLI_ASSOC);

            return $auth_link_result;
        }

        function gen_recovery_token($email) {
            global $app;

            $email = mysqli_real_escape_string($app->_db_, $email);
            $user = new User();

            if($user->user_exists_by_email($email)){
                $user_data = $user->fetch_by_email($email);
                $user_id = $user_data['id'];
                $token = new_token();

                //check if there is already a token for this user if there is then return the token

                $token_query = mysqli_query($app->_db_, "SELECT * FROM `zw_auth_links` WHERE user_id='$user_id'");
                $token_result = mysqli_fetch_assoc($token_query);

                if($token_result){
                    return $token_result['token'];
                } else {
                    $insert_query = mysqli_query($app->_db_, "INSERT INTO `zw_auth_links` (`id`, `type`, `token`, `user_id`, `date_created`) VALUES (NULL, '0', '$token', '$user_id', current_timestamp())");
                
                    if($insert_query){
                        return $token;
                    }    
                }
            } else {
                return false;
            }
        }

        function validate_recovery_token($token) {
            global $app;

            $token = mysqli_real_escape_string($app->_db_, $token);
            $token_query = mysqli_query($app->_db_, "SELECT * FROM `zw_auth_links` WHERE token='$token'");
            $token_result = mysqli_fetch_assoc($token_query);

            if($token_result){
                return $token_result;
            } else {
                return false;
            }
        }

        function delete_recovery_token($token) {
            global $app;

            $token = mysqli_real_escape_string($app->_db_, $token);
            $token_query = mysqli_query($app->_db_, "DELETE FROM `zw_auth_links` WHERE token='$token'");

            if($token_query){
                return true;
            } else {
                return false;
            }
        }

        function delete_auth_link_by_id($id) {
            global $app;

            $id = mysqli_real_escape_string($app->_db_, $id);
            $token_query = mysqli_query($app->_db_, "DELETE FROM `zw_auth_links` WHERE id='$id'");

            if($token_query){
                return true;
            } else {
                return false;
            }
        }

        //generate token for activation of user account
        function gen_activation_token($email) {
            global $app;

            $email = mysqli_real_escape_string($app->_db_, $email);
            $user = new User();

            if($user->user_exists_by_email($email)){
                $user_data = $user->fetch_by_email($email);
                $user_id = $user_data['id'];
                $token = new_token();

                //check if there is already a token for this user if there is then return the token

                $token_query = mysqli_query($app->_db_, "SELECT * FROM `zw_auth_links` WHERE user_id='$user_id'");
                $token_result = mysqli_fetch_assoc($token_query);

                if($token_result){
                    return $token_result['token'];
                } else {
                    $insert_query = mysqli_query($app->_db_, "INSERT INTO `zw_auth_links` (`id`, `type`, `token`, `user_id`, `date_created`) VALUES (NULL, '2', '$token', '$user_id', current_timestamp())");
                
                    if($insert_query){
                        return $token;
                    }    
                }
            } else {
                return false;
            }
        }

        //validate and delete
        function validate_activation_token($token) {
            global $app;

            $token = mysqli_real_escape_string($app->_db_, $token);
            $token_query = mysqli_query($app->_db_, "SELECT * FROM `zw_auth_links` WHERE token='$token' AND type='2'");
            $token_result = mysqli_fetch_assoc($token_query);

            if($token_result){
                return $token_result;
            } else {
                return false;
            }

        }

    }
?>