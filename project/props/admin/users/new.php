<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New User</h4>
                </div>
                <form class="card-body" action="amvc.api" api-key="admin/user/new.php" callback="formHandler" method="post" async="true">
                    <!-- subject -->
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Role</label>
                        <!-- option -->
                        <select class="form-control" id="exampleFormControlSelect1" name="role">
                            <option value="1">Admin</option>
                            <option value="0">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Password</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="password">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-success" id="reply">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>