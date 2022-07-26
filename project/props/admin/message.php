<!-- reply page -->
<?php
    $user = new User();
    $users = $user->fetch_all();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <script reload="yes">
            const addUserId = () => {
                let user_id = document.getElementById("user_id").value;
                let user_ids = document.getElementById("user_ids");
                
                user_ids.value += user_id + ",";
                let user_ids_purified = user_ids.value.split(',');
                
                //remove all duplicate values
                user_ids_purified = user_ids_purified.filter(function(item, pos) {
                    return user_ids_purified.indexOf(item) == pos;
                });
                
                user_ids.value = user_ids_purified.join(',');
                user_ids.value = user_ids_purified;
            }
        </script>    
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reply</h4>
                </div>
                <form class="card-body" action="amvc.api" api-key="admin/message.php" callback="formHandler" method="post" async="true">
                    <!-- subject -->
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Subject</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="subject">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="content" class="form-control" id="message" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user">To:</label>
                        <input class="form-control" value="<?= req_var('u_id') ? req_var('u_id').',' : ''?>" id="user_ids" name="user_ids">
                    <!-- option for all user emails -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">User ids</label>
                        <select class="form-control" id="user_id">
                            <option value="*" style="color: #333 !important;">All users</option>
                            <?php
                                foreach ($users as $current_user) {
                                    $selected = '';

									if ($current_user['id'] == $_data['user_id']) {
										$selected = 'selected';
									}
                                    
                                    echo "<option style='color: #333 !important;' value='{$current_user['id']}' $selected>{$current_user['email']}</option>";
                                }
                            ?>
                        </select>
                        <span onclick="addUserId()" class="btn btn-info">Add</span>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-success" id="reply">Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>