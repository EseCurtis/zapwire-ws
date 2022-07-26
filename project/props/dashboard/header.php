<?php
global $app;

$user = new User();
$report = new Report();

$darkmode_status = $user->get_logged_in_user_darkmode_status();
$profile_image = $user->get_logged_in_user_profile_image();
if(strpos($profile_image, 'user-default')){
  $profile_image = $app->url($profile_image);
}

$darkmode_class = $darkmode_status ? "darkmode" : "";

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?= $app->url('src/') ?>assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title><?= ucfirst($app->project_info['dashboard_app_name']) ?> - <?php echo $_data['title'] ?? 'Page'; ?></title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" async="true" href="<?=$app->url($app->project_info['logos']['z6']) ?>" />

  <!-- Fonts -->
  <link rel="preconnect" async="true" href="https://fonts.googleapis.com" />
  <link rel="preconnect" async="true" href="https://fonts.gstatic.com" crossorigin />
  <link async="true" href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" async="true" href="<?= $app->url('src/') ?>assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" async="true" href="<?= $app->url('src/') ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" async="true" href="<?= $app->url('src/') ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" async="true" href="<?= $app->url('src/') ?>assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" async="true" href="<?= $app->url('src/') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" async="true" href="<?= $app->url('src/') ?>assets/vendor/libs/apex-charts/apex-charts.css" />
  <link async="true" href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="<?= $app->url('src/') ?>assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= $app->url('src/') ?>assets/js/config.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- import datatables from dtbs dir using $app->url() -->
  <link rel="stylesheet" async="true" href="<?= $app->url('src/') ?>assets/libs/dtbs/vanilla-dataTables.css" />
  <script src="<?= $app->url('src/') ?>assets/libs/dtbs/vanilla-dataTables.js"></script>
  <!-- inclde darkmode.css -->
  <link rel="stylesheet" async="true" href="<?= $app->url('src/') ?>assets/css/darkmode.css" />
  <script>
    let darkmode_status = <?= $darkmode_status ?>
  </script>
</head>

<?php
  $widget = new Render("widgets", "php");
  $widget->prop('loading');
?>

<body class="<?=$darkmode_class?>">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a async="true" href="<?=$app->url("/dashboard")?>" class="app-brand-link">
            <img src="<?=$app->url($app->project_info['logos']['z5']) ?>" alt="Brand" class="app-brand-logo"  style="width: 25px; height: 25px;"/>
            <span class="app-brand-text demo menu-text fw-bolder ms-2"><?=$app->project_info['app_name']?></span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Dashboard</span></li>
           
          <!-- Dashboard -->
          <li class="menu-item <?= $_data['current_page'] == '' ? 'active' : '' ?>">
            <a async="true" href="<?= $app->url('dashboard/') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Overview and Analysis</div>
            </a>
          </li>

          <li class="menu-item <?= $_data['current_page'] == 'msgs' ? 'active' : '' ?>">
            <a async="true" href="<?= $app->url('dashboard/messages') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-bell"></i>
              <div data-i18n="Analytics">Messages</div>
            </a>
          </li>

          <li class="menu-item <?= $_data['current_page'] == 'rprt' ? 'active' : '' ?>">
            <a async="true" href="<?= $app->url('dashboard/report') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-bell"></i>
              <div data-i18n="Analytics">Send Report</div>
            </a>
          </li>

          <li class="menu-header small text-uppercase"><span class="menu-header-text">Channel Management</span></li>
            
          <li class="menu-item <?= $_data['current_page'] == 'channels' ? 'active' : '' ?>">
            <a async="true" href="<?= $app->url('dashboard/channels') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-candles"></i>
              <div data-i18n="Analytics">My Channels</div>
            </a>
          </li>

          <!-- create channel link -->
          <li class="menu-item <?= $_data['current_page'] == 'create_channel' ? 'active' : '' ?>">
            <a async="true" href="<?= $app->url('dashboard/channels/create') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-plus"></i>
              <div data-i18n="Analytics">New Channel</div>
            </a>
          </li>

          <!-- generate wire code  link -->
          <li class="menu-item <?= $_data['current_page'] == 'gen_w_code' ? 'active' : '' ?>">
            <a async="true" href="<?= $app->url('dashboard/channels/gen') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-code"></i>
              <div data-i18n="Analytics">Generate Wire Code</div>
            </a>
          </li>

          <!-- generate wire code  link -->
          <li class="menu-item <?= $_data['current_page'] == 'ch_logs' ? 'active' : '' ?>">
            <a async="true" href="<?= $app->url('dashboard/channels/logs') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-sort-alt-2"></i>
              <div data-i18n="Analytics">Channel Logs</div>
            </a>
          </li>

          <li class="menu-header small text-uppercase"><span class="menu-header-text">Account</span></li>
           
          <!-- settings link -->
          <li class="menu-item <?= $_data['current_page'] == 'settings' ? 'active' : '' ?>">
            <a async="true" href="<?= $app->url('dashboard/settings') ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-cog"></i>
              <div data-i18n="Analytics">Settings</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" async="true" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

            <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="notif-icon avatar <?=$report->get_unread_messages_count() > 0 ? 'avatar-online' : ''?>">
                    <!-- bell icon-->
                    <i class="bx bx-bell bx-sm"></i>
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <!-- messages notifications-->
                  <?php foreach($report->get_unread_messages() as $current_message): ?>
                    <li class="nav-link"><a async="true" href="<?=$app->url("dashboard/messages?m_id={$current_message['id']}")?>" class="nav-item dropdown-item"><?=$current_message['subject']?></a></li>
                  <?php endforeach; ?>
                  <?php
                    if(!$report->get_unread_messages()){
                      echo '<li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">No new Messages</a></li>';
                    }
                  ?>
                </ul>
              </li>
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="<?=$profile_image?>" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="<?=$user->logged_in_user_is_admin() ? $app->url('admin-board') : '#'?>">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="<?=$profile_image?>" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">
                            <!-- extract name from email and print out current user name -->
                            <?= explode('@', $_SESSION['email'])[0] ?>
                          </span>
                          <small class="text-muted"><?=$user->get_logged_in_user_role()?></small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <!-- darkmode switch -->
                  <li>
                    <a class="dropdown-item darkmode-switch" async="true" href="javascript:void(0)" id="darkmode-switch">
                      <i class="bx bx-moon me-2"></i>
                      <span class="align-middle">Darkmode</span>
                    </a>
                  </li>
                  <!-- darkmode switch -->

                  <li>
                    <a class="dropdown-item" async="true" href="<?=$app->url("settings")?>">
                      <i class="bx bx-cog me-2"></i>
                      <span class="align-middle">Settings</span>
                    </a>
                  </li>
                  <!-- include darkmode switch -->
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" async="true" href="<?=$app->url("logout")?>">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->


        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">