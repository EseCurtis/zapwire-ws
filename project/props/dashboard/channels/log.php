<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">channel id</th>
                                <th scope="col">status</th>
                                <th scope="col">requested from</th>
                                <th scope="col">date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $log = new Log();
                                $logs = $log->read($_data['ch_id'], $_SESSION['user_id']);
                                $i = 1;
                                foreach($logs as $l){

                                    $message = "<span class=\"badge bg-label-success\">Connection</span>";
                                    switch($l['status']){
                                        case "1":
                                            $message = "<span class=\"badge bg-label-success\" title='{$l['message']}'>Connection</span>";
                                            break;
                                        case "2":
                                            $message = "<span class=\"badge bg-label-info\" title='{$l['message']}'>Disconnection</span>";
                                            break;
                                        case "3":
                                            $message = "<span class=\"badge bg-label-danger\" title='{$l['message']}'>Disconnection</span>";
                                            break;
                                        case "4":
                                            $message = "<span class=\"badge bg-label-danger\" title='{$l['message']}'>Error</span>";
                                            break;
                                        case "5":
                                            $message = "<span class=\"badge bg-label-success\" title='{$l['message']}'>Success</span>";
                                            break;
                                    }

                                    echo "<tr>";
                                    echo "<th scope='row'>$i</th>";
                                    echo "<td>{$l['ch_id']}</td>";
                                    echo "<td>{$message}</td>";
                                    echo "<td>{$l['requested_from']}</td>";
                                    echo "<td>{$l['date_created']}</td>";
                                    echo "</tr>";
                                    $i++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>