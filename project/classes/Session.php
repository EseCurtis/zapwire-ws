<?php 
    class Session {
        function create($channel_key) {
            global $app;
            
            $token = new_token();
            $channel = new Channel();
            $channel_id = $channel->fetch_by_key($channel_key)['id'];

            $create_query = mysqli_query($app->_db_, "INSERT INTO `zw_sessions` (`id`, `token`, `channel_id`, `date_created`) VALUES (NULL, '$token', '$channel_id', CURRENT_TIMESTAMP)");

            if($create_query){
                return $token;
            }

            return false;
        }

        function fetch_channel($token) {
            global $app;

            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_sessions` WHERE token='$token'");
            $fetch_result = mysqli_fetch_assoc($fetch_query);

            $channel = new Channel();

            $current_channel = $channel->fetch_row($fetch_result['channel_id']);

            return $current_channel ?? false;
        }

        function delete($token) {
            global $app;

            $delete_query = mysqli_query($app->_db_, "DELETE FROM `zw_sessions` WHERE token='$token'");

            if($delete_query){
                return true;
            }

            return false;
        }
    
    }