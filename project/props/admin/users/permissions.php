<!-- reply page -->
<?php
    $user = new User();
    $current_user = $user->fetch_by_id($_data['user_id']);

    function is_it($value, $match, $return){
        if($value == $match){
            return $return;
        }
        return '';
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-12"> 
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Permissions</h4>
                </div>
                <form class="card-body" action="amvc.api" api-key="admin/user/permissions.php" callback="formHandler" method="post" async="true">
                    <input type="hidden" name="user_id" value="<?=$current_user['id']?>">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Role</label>
                        <div class="form-checkx">
                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="role" value="0" <?=is_it($current_user['type'], 0, 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                User
                            </label>

                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="role" value="1" <?=is_it($current_user['type'], 1, 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                Admin
                            </label>
                        </div>
                    </div>

                    <!-- check box -->
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Permissions</label>
                        <div class="form-checkx">
                            <p>Disabled</p>
                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="disabled" value="0" <?=is_it($current_user['deactivated'], '0', 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                No
                            </label>

                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="disabled" value="1" <?=is_it($current_user['deactivated'], '1', 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                Yes
                            </label>
                        </div>
                        <div class="form-checkx">
                            <p>Is Activated</p>
                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="is_activated" value="0" <?=is_it($current_user['is_activated'], '0', 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                No
                            </label>
                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="is_activated" value="1" <?=is_it($current_user['is_activated'], '1', 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                Yes
                            </label>
                        </div>
                        <div class="form-checkx">
                            <p>Darkmode</p>
                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="darkmode" value="0" <?=is_it($current_user['darkmode'], '0', 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                No
                            </label>
                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="darkmode" value="1" <?=is_it($current_user['darkmode'], '1', 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                Yes
                            </label>
                        </div>

                        <div class="form-checkx">
                            <p>Have Logged In</p>
                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="have_logged_in" value="0" <?=is_it($current_user['have_logged_in'], '0', 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                No
                            </label>
                            <input class="form-check-inputx" type="radio" id="exampleCheck1" name="have_logged_in" value="1" <?=is_it($current_user['have_logged_in'], '1', 'checked')?>>
                            <label class="form-check-label" for="exampleCheck1">
                                Yes
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-success" id="reply">Update</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- form for delete -->
                <div class="clearfix"></div>
                <hr>
                <form class="card-body" action="amvc.api" api-key="admin/user/permissions/delete.php" callback="formHandler" method="post" async="true">
                    <input type="hidden" name="user_id" value="<?=$current_user['id']?>">    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-error" id="reply">Delete User</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>