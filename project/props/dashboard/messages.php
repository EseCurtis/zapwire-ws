<!-- display all messages -->

<?php
  $report = new Report();
  $number_of_unread_messages = $report->get_unread_messages_count() ?? 0;
  $all_messages = $report->get_all_messages();
?>
<div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
              <div class="card-header ">
                <h6 class="title d-inline">Unread(<?=$number_of_unread_messages?>)</h6>
                <div class="dropdown">
                  <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                    <i class="tim-icons icon-settings-gear-63"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#pablo">Delete all</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                      
                      <?php 
                        foreach ($all_messages as $current_message) {
                          $user = new User();
                          $current_message['sender_name'] = $user->fetch_by_id($current_message['author_id'])['email']; 
                      ?>
                        <tr class="report <?=$current_message['read_status'] == '0' ? 'unread' : '';?>" async="true" href="<?=$app->url("dashboard/messages?m_id={$current_message['id']}")?>">
                          <td>
                            <p class="title"><?=$current_message["subject"]; ?></p>
                            <p class="text-muted"><?=$current_message["content"]; ?></p>
                          </td>
                          <td class="td-actions text-right">
                            <p>
                              <small class="text-muted">
                                From: <?=$current_message["sender_name"]; ?>
                              </small>
                            </p>
                            <p>
                              <small class="time-ago" data-time="<?=$current_message["date_created"]; ?>">
                                {{time}}
                              </small>
                            </p>
                          </td>
                        </tr>
                      <?php } ?>

                      <!-- youre all caught up -->
                      <?php if(count($all_messages) < 1){?>
                        <tr>
                        <td>
                          
                        </td>
                        <td>
                          <p class="title">You're all caught up</p>
                          <p class="text-muted">There are no new reports.</p>
                        </td>
                        <td class="td-actions text-right">
                          <button type="button" rel="tooltip" title="" class="btn btn-link" data-original-title="Edit Task">
                            <i class="tim-icons icon-pencil"></i>
                          </button>
                        </td>
                      </tr>
                      <?php } ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <style>
            .report.unread {
              background-color: #f5f5f505;
              border-left: 10px solid var(--blue);
              padding-left: 0.5em !important;
            }
            .report:hover {
              background-color: #f5f5f510;
            }
          </style>