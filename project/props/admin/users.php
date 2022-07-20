<?php
    $user = new User();
    $all_users = $user->fetch_all();
?>
<div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> User Data</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Email
                        </th>
                        <th>
                          Disabled
                        </th>
                        <th>
                          Logged in
                        </th>
                        <th>
                          Activated
                        </th>
                        <th class="text-center" colspan="3">
                          Actions
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($all_users as $current_user) { ?>
                        
                        <tr>
                            <td>
                            <?= $current_user["email"]; ?>
                            </td>
                            <td>
                            <?= $current_user["deactivated"] == '1' ? "<div class='badge badge-success'>yes</div>" : "<div class='badge badge-warning'>no</div>"; ?>
                            </td>
                            <td>
                            <?= $current_user["have_logged_in"] == '1' ? "<div class='badge badge-success'>yes</div>" : "<div class='badge badge-warning'>no</div>"; ?>
                            </td>
                            <td>
                            <?= $current_user["is_activated"] == '1' ? "<div class='badge badge-success'>yes</div>" : "<div class='badge badge-warning'>no</div>"; ?>
                            </td>
                            <td class="text-center">
                                
                                <a href="<?= $app->url('admin/users/permissions/'.$current_user["id"]); ?>" class="btn btn-warning">
                                    <i class="material-icons">Permissions</i>
                                </a>
                                <a href="<?= $app->url('admin/users/update/'.$current_user["id"]); ?>" class="btn btn-info">
                                    <i class="material-icons">Update</i>
                                </a>
                                <a data-user-id="<?=$current_user["id"]?>" class="btn btn-danger">
                                    <i class="material-icons">Deactivate</i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>