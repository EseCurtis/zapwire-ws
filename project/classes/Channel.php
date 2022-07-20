<?php
    class Channel {
        function create($path, $authorized_hostnames, $headers) {
            global $app;

            $user = new User();

            $ch_key = substr(new_token(), 0, 17);
            $user_id = $user->get_loggedin_user()['id'];

            $create_query = mysqli_query($app->_db_, "INSERT INTO `zw_channels` (`id`, `ch_key`, `path`, `authorized_hostnames`, `headers`, `ref_id`, `date_created`) VALUES (NULL, '$ch_key', '$path', '$authorized_hostnames', '$headers', '$user_id', CURRENT_TIMESTAMP)");

            return $create_query ? 1 : 0;
        }

        function update($id, $path, $authorized_hostnames, $headers) {
            global $app;

            $update_query = mysqli_query($app->_db_, "UPDATE `zw_channels` SET `path`='$path', 'authorized_hostnames'=`$authorized_hostnames`, `headers`='$headers' WHERE `id`='$id'");

            return $update_query ? 1 : 0;
        }

        function update_single($id, $field, $value) {
            global $app;

            $update_query = mysqli_query($app->_db_, "UPDATE `zw_channels` SET `$field`='$value' WHERE `id`='$id'");

            return $update_query ? 1 : 0;
        }

        function fetch_row($id, $auth_logged_in_ownership = false) {
            global $app;

            $user = new User();

            $user_id = $user->get_loggedin_user()['id'];

            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_channels` WHERE `id`='$id'");

            if ($fetch_query) {
                $fetch_row = mysqli_fetch_assoc($fetch_query);

                if ($auth_logged_in_ownership) {
                    if ($fetch_row['ref_id'] == $user_id) {
                        return $fetch_row;
                    }
                } else {
                    return $fetch_row;
                }
            }

            return false;

        }

        function fetch($id) {
            global $app;

            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_channels` WHERE `id`='$id'");
            $fetch_result = mysqli_fetch_assoc($fetch_query);

            return $fetch_result['path'] ?? false;
        }

        function fetch_by_key($ch_key) {
            global $app;

            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_channels` WHERE `ch_key`='$ch_key'");
            $fetch_result = mysqli_fetch_assoc($fetch_query);

            return $fetch_result ?? false;
        }

        function fetch_all($user_id = false) {
            global $app;

            $query = "SELECT * FROM `zw_channels`";

            if ($user_id) {
                $query = "SELECT * FROM `zw_channels` WHERE `ref_id`='$user_id'";
            }

            $fetch_query = mysqli_query($app->_db_, $query);
            $fetch_result = mysqli_fetch_all($fetch_query, MYSQLI_ASSOC);

            return $fetch_result ?? false;
        }

        function delete($id) {
            global $app;

            $delete_query = mysqli_query($app->_db_, "DELETE FROM `zw_channels` WHERE `id`='$id'");

            return $delete_query ? 1 : 0;
        }

        function user_owns_channel($user_id, $channel_id) {
            global $app;

            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_channels` WHERE `id`='$channel_id' AND `ref_id`='$user_id'");
            $fetch_result = mysqli_fetch_assoc($fetch_query);

            return $fetch_result ?? false;
        }

        function user_channels_count($user_id) {
            global $app;

            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_channels` WHERE `ref_id`='$user_id'");
            $fetch_result = mysqli_fetch_all($fetch_query, MYSQLI_ASSOC);

            return count($fetch_result);
        }

        function fetch_all_logged_in_user_channels() {
            global $app;

            $user = new User();
            $user_id = $user->get_loggedin_user()['id'];

            $fetch_query = mysqli_query($app->_db_, "SELECT * FROM `zw_channels` WHERE `ref_id`='$user_id'");
            $fetch_result = mysqli_fetch_all($fetch_query, MYSQLI_ASSOC);

            return $fetch_result ?? false;
        }
    }

?>