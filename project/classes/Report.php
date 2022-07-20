<?php
    class Report {
        function send ($subject, $content, $author_id = '21520', $type = 0) {
            global $app;

            $send_query = mysqli_query($app->_db_, "INSERT INTO `zw_reports` (`id`,`author_id`, `subject`, `content`, `read_status`, `type`, `date_created`) VALUES (NULL, '$author_id', '$subject', '$content', '0', '$type', current_timestamp())");
            
            if ($send_query) {
                return true;
            } else {
                return false;
            }
        }

        function message ($subject, $content, $author_id = '21520') {

            if($author_id == '*') {
                $user = new User();
                $all_user = $user->fetch_all();

                foreach ($all_user as $current_user) {
                    $this->send($subject, $content, $current_user['id'], 1);
                }

            } else if(@$author_id[0]) {

                $author_id = (array) $author_id;
                $author_id = array_unique($author_id);

                foreach ($author_id as $current_id) {
                    if($current_id == '*') {
                        return;
                    }
                    $this->send($subject, $content, $current_id, 1);
                }

            } else {
                return 0;
            }
            return 1;
        }

        function get_reports () {
            global $app;

            $get_reports_query = mysqli_query($app->_db_, "SELECT * FROM `zw_reports` WHERE `type` = 0");
            $get_reports_query = mysqli_fetch_all($get_reports_query, MYSQLI_ASSOC);
            
            if ($get_reports_query) {
                return $get_reports_query;
            } else {
                return false;
            }
        }

        function get_report ($id) {
            global $app;

            $get_report_query = mysqli_query($app->_db_, "SELECT * FROM `zw_reports` WHERE `id` = '$id'");
            $get_report_query = mysqli_fetch_all($get_report_query, MYSQLI_ASSOC);
            
            if ($get_report_query) {
                return $get_report_query[0];
            } else {
                return false;
            }
        }

        function get_reports_by_author ($author_id) {
            global $app;

            $get_reports_query = mysqli_query($app->_db_, "SELECT * FROM `zw_reports` WHERE `author_id` = '$author_id' ORDER BY `date_created` DESC");
            $get_reports_query = mysqli_fetch_all($get_reports_query, MYSQLI_ASSOC);
            
            if ($get_reports_query) {
                return $get_reports_query;
            } else {
                return false;
            }
        }

        //get if there is any unread report within the first 5 reports
        function get_unread_reports () {
            global $app;

            $get_reports_query = mysqli_query($app->_db_, "SELECT * FROM `zw_reports` WHERE `read_status` = '0' AND `type` = '0' ORDER BY `date_created` DESC LIMIT 5");
            $get_reports_query = mysqli_fetch_all($get_reports_query, MYSQLI_ASSOC);

            if ($get_reports_query) {
                return $get_reports_query;
            } else {
                return false;
            }
        }

        //get number of unread messages
        function get_unread_reports_count () {
            global $app;

            $get_reports_query = mysqli_query($app->_db_, "SELECT * FROM `zw_reports` WHERE `read_status` = '0' AND `type` = '0'");
            $get_reports_query = mysqli_fetch_all($get_reports_query, MYSQLI_ASSOC);

            if ($get_reports_query) {
                return count($get_reports_query);
            } else {
                return false;
            }
        }

        function get_all_messages() {
            global $app;

            $user = new User();
            $user_id = $user->get_loggedin_user()['id'];

            $get_reports_query = mysqli_query($app->_db_, "SELECT * FROM `zw_reports` WHERE `type` = 1  AND `author_id` = '$user_id' ORDER BY `date_created` DESC");
            $get_reports_query = mysqli_fetch_all($get_reports_query, MYSQLI_ASSOC);

            if ($get_reports_query) {
                return $get_reports_query;
            } else {
                return false;
            }
        }

        //get reports with type = 1 and read_status = 0 and also id matches currently logged in user

        function get_unread_messages(){
            global $app;
            $user = new User();
            $user_id = $user->get_loggedin_user()['id'];
            $get_reports_query = mysqli_query($app->_db_, "SELECT * FROM `zw_reports` WHERE `read_status` = '0' AND `type` = '1' AND `author_id` = '$user_id' ORDER BY `date_created` DESC");
            $get_reports_query = mysqli_fetch_all($get_reports_query, MYSQLI_ASSOC);

            if ($get_reports_query) {
                return $get_reports_query;
            } else {
                return false;
            }
        }

        function get_unread_messages_count() {
            global $app;
            $user = new User();
            $user_id = $user->get_loggedin_user()['id'];
            $get_reports_query = mysqli_query($app->_db_, "SELECT * FROM `zw_reports` WHERE `read_status` = '0' AND `type` = '1' AND `author_id` = '$user_id'");
            $get_reports_query = mysqli_fetch_all($get_reports_query, MYSQLI_ASSOC);

            if ($get_reports_query) {
                return count($get_reports_query);
            } else {
                return false;
            }
        }

        function read ($id) {
            global $app;

            $read_report_query = mysqli_query($app->_db_, "UPDATE `zw_reports` SET `read_status` = '1' WHERE `id` = '$id'");
            
            if ($read_report_query) {
                return true;
            } else {
                return false;
            }
        }
        
    }
?>