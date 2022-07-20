          
            <?php
              $_user = new User();
              $log = new Log();
              $widget = new Render("widgets/", "php");

              $user = $_user->get_loggedin_user();
              if(!$_user->have_logged_in($user['id'])){
              
            ?>
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Congratulations <?=$user['email']?>! 🎉</h5>
                  <p class="mb-4">
                    Your account has been created successfully.
                    <br>
                    Get Started by creating a channel!
                  </p>

                  <a href="<?=$app->url('dashboard/channels/create')?>" class="btn btn-sm btn-outline-primary"> Create a new channel</a>
                </div>
              </div>

            <?php
              $_user->set_logged_in($user['id']);
              }
            ?>
                <div class="card">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-body">
                        <h5 class="card-title text-primary">Channels</h5>
                        <p class="mb-4">
                          Here you can see all your channels.
                        </p>
                        <a href="<?=$app->url('dashboard/channels')?>" class="btn btn-sm btn-outline-primary">View all channels</a>
                      </div>
                    </div>

                    <?php
                      $widget->prop('o-card', [
                        "count" => $log->user_logs_count($user['id'], 1),
                        "label" => "Successfull Connections",
                        "icon" => "bx bx-check-circle",
                        "route_to" => "dashboard/channels/logs?category=1",
                        //use hex
                        "icon_theme" => "#28a745"
                      ]);

                      $widget->prop('o-card', [
                        "count" => $log->user_logs_count($user['id'], 2),
                        "label" => "Successfull Disconnections",
                        "icon" => "bx bx-x-circle",
                        "route_to" => "dashboard/channels/logs?category=1",
                        //use hex blue hue
                        "icon_theme" => "#007bff"
                      ]);

                      $widget->prop('o-card', [
                        "count" => $log->user_logs_count($user['id'], 3),
                        "label" => "Auth based Disconnections",
                        "icon" => "bx bx-lock",
                        "route_to" => "dashboard/channels/logs?category=1",
                        //use hex
                        "icon_theme" => "#6c757d"
                      ]);

                      $widget->prop('o-card', [
                        "count" => $log->user_logs_count($user['id'], 4),
                        "label" => "Error aided Disconnections",
                        "icon" => "bx bx-x-circle",
                        "route_to" => "dashboard/channels/logs?category=1",
                        //use hex
                        "icon_theme" => "#ffc107"
                      ]);
                    ?>
                  </div>
                    </div>