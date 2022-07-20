<?php
  $report = new Report();
  $number_of_unread_reports = $report->get_unread_reports_count() ?? 0;
  $all_reports = $report->get_reports();
?>
<div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
              <div class="card-header ">
                <h6 class="title d-inline">Unread(<?=$number_of_unread_reports?>)</h6>
                <p class="card-category d-inline">Reports</p>
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
                        foreach ($all_reports as $current_report) {
                          $user = new User();
                          $current_report['sender_name'] = $user->fetch_by_id($current_report['author_id'])['email']; 
                      ?>
                        <tr class="report <?=$current_report['read_status'] == '0' ? 'unread' : '';?>" async="true" href="<?=$app->url("admin-board/reports?r_id={$current_report['id']}")?>">
                          <td>
                            <p class="title"><?=$current_report["subject"]; ?></p>
                            <p class="text-muted"><?=$current_report["content"]; ?></p>
                          </td>
                          <td class="td-actions text-right">
                            <p>
                              <small class="text-muted">
                                From: <?=$current_report["sender_name"]; ?>
                              </small>
                            </p>
                            <p>
                              <small class="time-ago" data-time="<?=$current_report["date_created"]; ?>">
                                {{time}}
                              </small>
                            </p>
                          </td>
                        </tr>
                      <?php } ?>

                      <!-- youre all caught up -->
                      <?php if(count($all_reports) < 1){?>
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