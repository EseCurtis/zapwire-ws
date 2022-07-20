<?php
    class Stat {
        function get_per_months($year, $type = 'users') {
            //group records in months of the year by date_created
            $records = $this->get_by_year($year, $type);
            //get the number of users in each month
            $records_by_month = array();
            foreach ($records as $record) {
                $month = date('m', strtotime($record['date_created']));

                if($month[0] == 0){
                    $month = substr($month, 1);
                }

                if (!isset($records_by_month[$month])) {
                    $records_by_month[$month] = 0;
                }
                $records_by_month[$month]++;
            }
            //return the array of users by month
            return $records_by_month;
        }

        function to_array($per_months) {
            $temp_array = [];

            for ($i=1; $i <= 12; $i++) { 
                if($per_months[$i]) {
                    $temp_array[] = $per_months[$i];
                } else {
                    $temp_array[] = 0;
                }
            }

            return $temp_array;
        }

        function get_total($type, $year = false) {
            global $app; 

            if($year) {
                return count($this->get_by_year($year, $type));
            }

            $sql = "SELECT COUNT(*) AS total FROM `zw_$type`";
            $result = mysqli_query($app->_db_, $sql);
            $total = mysqli_fetch_assoc($result);

            return $total['total'];
        }

        private function get_by_year($year, $type){
            global $app;

            $get_by_year_query = mysqli_query($app->_db_, "SELECT * FROM `zw_$type` WHERE YEAR(`date_created`)='$year'");
            $get_by_year_result = mysqli_fetch_all($get_by_year_query, MYSQLI_ASSOC);

            if($get_by_year_result){
                return $get_by_year_result;
            }
        }
    }
?>