<?php 
    class Service {
        function __construct() {
            global $app;

            $this->_db_ = $app->_db_;

        }

        private function check($date, $dead_line, $variables, $callback) {
            global $app;

            $date = new DateTime($date);
            $now = new DateTime($dead_line);

            if($date >= $now) {
                $callback($variables);
            }
        }

        private function check_logs() {
            $user = new User();
            $log = new Log();
            $service = new Service();

            $users = $user->fetch_all();

            foreach($users as $this_user){
                $logs = $log->read_by_user_id($this_user['id']);

                foreach($logs as $this_log){
                    $log_deadline = date('Y-m-d h:i:s', strtotime('+7 days' . $this_log['date_created']));
                    $todays_date = date('Y-m-d h:i:s');

                    $service->check($todays_date, $log_deadline, $this_log['id'], function ($log_id) {
                        $log = new Log();
                        $log->dump($log_id);
                    });
                }
            }
        }

        private function check_auth_links () {
            $auth_link = new AuthLink();
            $service = new Service();

            $auth_links = $auth_link->fetch_all();

            foreach($auth_links as $this_auth_link){
                $auth_link_deadline = date('Y-m-d h:i:s', strtotime('+2 days' . $this_auth_link['date_created']));
                $todays_date = date('Y-m-d h:i:s');

                $service->check($todays_date, $auth_link_deadline, $this_auth_link['id'], function ($auth_link_id) {
                    $auth_link = new AuthLink();
                    $auth_link->delete_auth_link_by_id($auth_link_id);
                });
            }
        }

        //delete user account if they have nnot been activated for more than 7 days
        function check_user_accounts() {
            $user = new User();
            $service = new Service();

            $users = $user->fetch_all();

            foreach($users as $this_user){
                $user_deadline = date('Y-m-d h:i:s', strtotime('+7 days' . $this_user['date_created']));
                $todays_date = date('Y-m-d h:i:s');

                $service->check($todays_date, $user_deadline, $this_user['id'], function ($user_id) {
                    $user = new User();
                    $user->deactivate($user_id);
                });
            }
        }

        public function start() {
            $this->check_logs();
            $this->check_auth_links();
            //$this->check_user_accounts();
        }
    }
?>