<!-- report page -->
<?php
    $user = new User();
    $users = $user->fetch_all();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">   
        <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Reply</h4>
                </div>
                <form class="card-body" action="amvc.api" api-key="user/report.php" callback="formHandler" method="post" async="true">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-success" id="reply">Report</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>