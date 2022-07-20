
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table" id="custom-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Key</th>
                                <th scope="col">Path</th>
                                <th scope="col" colspan="2">Manage</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $logged_in_user_id = $_SESSION['user_id'];
                                $channel = new Channel();
                                $channels = $channel->fetch_all($logged_in_user_id);
                                $i = 1;
                                foreach($channels as $ch){
                                    echo "<tr>";
                                    echo "<th scope='row'>$i</th>";
                                    echo "<td>{$ch['ch_key']}</td>";
                                    echo "<td>{$ch['path']}</td>";
                                    echo "<td><a href='{$app->url('dashboard/channels/log/'.$ch['id'])}' class='btn btn-primary'>Logs</a></td>";
                                    echo "<td><a href='{$app->url('dashboard/channels/gen?ch_id='.$ch['id'])}' class='btn btn-warning'>Gen</a></td>";
                                    echo "<td><a href='{$app->url('dashboard/channels/edit/'.$ch['id'])}' class='btn btn-primary'>Edit</a></td>";
                                    echo "<td><a href='{$app->url('dashboard/channels/delete/'.$ch['id'])}' class='btn btn-danger'>Delete</a></td>";
                                    echo "</tr>";
                                    $i++;
                                }

                                if (count($channels) == 0) {
                                    echo "<tr>";
                                    echo "<td colspan='4' class='text-center' style='width: 100%; display:flex; justify-items:center; align-items:center'>You're all caught up!  ";
                                    echo '<svg style="width:25px; height: 50px;" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>';
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>