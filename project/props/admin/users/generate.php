<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New User</h4>
                </div>
                <form class="card-body" action="amvc.api" api-key="admin/user/generate.php" callback="formHandler" method="post" async="true">
                    <!-- subject -->
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Users Data</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="user_datas">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-success" id="reply">Generate</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>