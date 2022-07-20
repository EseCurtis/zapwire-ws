<?php
    class Log {
        function write($channel_id, $request_from, $user_id, $status = 1, $message = "") {
            global $app;

            $logging = mysqli_query($app->_db_, "INSERT INTO `zw_logs` (`id`, `status`, `message`, `ch_id`, `ref_id`, `requested_from`, `date_created`) VALUES (NULL, '$status', '$message', '$channel_id', '$user_id', '$request_from', CURRENT_TIMESTAMP)");

            if ($logging) {
                return 1;
            } else {
                return 0;
            }
        }

        function read($channel_id, $user_id = false) {
            global $app;

            $auth = true;
            $channel  = new Channel();

            if($user_id) {
                $auth = $channel->user_owns_channel($user_id, $channel_id);
            }
            
            if($auth) {
                $logging = mysqli_query($app->_db_, "SELECT * FROM `zw_logs` WHERE `ch_id` = '$channel_id'");
            }

            if ($logging && $auth) {
                return $logging;
            } else {
                return 0;
            }
        }

        function read_by_user_id($user_id) {
            global $app;

            $logging = mysqli_query($app->_db_, "SELECT * FROM `zw_logs` WHERE `ref_id` = '$user_id'");

            if ($logging) {
                return $logging;
            } else {
                return 0;
            }
        }

        function user_logs_count($user_id, $filter = '*') {
            global $app;
            if ($filter == '*') {
                $logging_query = mysqli_query($app->_db_, "SELECT * FROM `zw_logs` WHERE `ref_id` = '$user_id'");
            } else {
                $logging_query = mysqli_query($app->_db_, "SELECT * FROM `zw_logs` WHERE `ref_id` = '$user_id' AND `status` = '$filter'");
            }

            $logging = $logging_query;

            if ($logging) {
                return mysqli_num_rows($logging);
            } else {
                return 0;
            }
        }

        //dump specific log to a txt file in the  bin directory with the name of the user _id
        function dump($log_id) {
            global $app;

            $this_log = mysqli_query($app->_db_, "SELECT * FROM `zw_logs` WHERE `id` = '$log_id'");
            $this_log = mysqli_fetch_assoc($this_log);

            $log_txt = json_encode($this_log).",";

            $file_name = "zw_user_log_{$this_log['ref_id']}.txt";
            $file_path = "vault/user_logs/{$file_name}";

            $file = fopen($file_path, "a");
            fwrite($file, $log_txt);
            fclose($file);  

            //delete log from database
            $delete_log = mysqli_query($app->_db_, "DELETE FROM `zw_logs` WHERE `id` = '$log_id'");

            if ($delete_log) {
                return 1;
            } else {
                return 0;
            }

            return 1;
        }

        //reverse engineer the Log::dump() function to get the log data from the txt file
        function get_log_dump($user_id) {
            $file_name = "zw_user_log_{$user_id}.txt";
            $file_path = "vault/user_logs/{$file_name}";

            $file = fopen($file_path, "r");
            $log_txt = fread($file, filesize($file_path));
            fclose($file);  

            return $this->read_dump($log_txt);
        }



        static function read_dump($dump) {
            //remove the last comma from the dump
            $dump = substr($dump, 0, -1);
            $dump = json_decode("[$dump]", true);

            return $dump;
        }
        
    }
?> 