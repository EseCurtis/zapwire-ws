<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
  $user = new User();
  $report = new Report();

  $logged_in_user = $user->get_loggedin_user();
  $unread_available = $report->get_unread_reports() ? 'notification' : null;
  $profile_image = $user->get_logged_in_user_profile_image();

  if(strpos($profile_image, 'user-default')){
    $profile_image = $app->url($profile_image);
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?=$app->url('src/assets/admin')?>/img/apple-icon.png">
   <!-- Favicon -->
   <link rel="icon" href="<?=$app->url($app->project_info['logos']['z6']) ?>" />
   <title><?= ucfirst($app->project_info['admin_app_name']) ?> - <?php echo $_data['title'] ?? 'Page'; ?></title>

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="<?=$app->url('src/assets/admin')?>/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="<?=$app->url('src/assets/admin')?>/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?=$app->url('src/assets/admin')?>/demo/demo.css" rel="stylesheet" />
  <!-- add sweet aleret from cdn -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar" data="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            <?= ucfirst($app->project_info['admin_app_name']) ?>
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            <?= ucfirst($app->project_info['admin_app_name']) ?>
          </a>
        </div>
        <ul class="nav">
          <li>
            <a href="<?=$app->url('admin-board/')?>">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Overview</p>
            </a>
          </li>
          <li>
            <a href="<?=$app->url('admin-board/reports')?>">
              <i class="tim-icons icon-bell-55"></i>
              <p>Reports</p>
            </a>
          </li>
          <li>
            <a href="<?=$app->url('admin-board/users')?>">
              <i class="tim-icons icon-single-02"></i>
              <p>Users</p>
            </a>
          </li>
          <li>
            <a href="<?=$app->url('admin-board/users/generate')?>">
              <i class="tim-icons icon-single-02"></i>
              <p>Generate Users</p>
            </a>
          </li>
          <li>
            <a href="<?=$app->url('admin-board/users/new')?>">
              <i class="tim-icons icon-single-02"></i>
              <p>Create User</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" data="blue">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)"><?=$_data['title']?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="dropdown nav-item">
                <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="<?=$unread_available?> d-none d-lg-block d-xl-block"></div>
                  <i class="tim-icons icon-sound-wave"></i>
                  <p class="d-lg-none">
                  Reports
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                  <?php foreach($report->get_unread_reports() as $current_report): ?>
                    <li class="nav-link"><a href="<?=$app->url("admin-board/reports?r_id={$current_report['id']}")?>" class="nav-item dropdown-item"><?=$current_report['subject']?></a></li>
                  <?php endforeach; ?>
                  <?php
                    if(!$report->get_unread_reports()){
                      echo '<li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">No new Reports</a></li>';
                    }
                  ?>
                </ul>
              </li>
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="<?=$profile_image?>" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="<?=$app->url('dashboard');?>" class="nav-item dropdown-item">Switch Account mode</a></li>
                  <li class="dropdown-divider"></li>
                  <li class="nav-link"><a href="<?=$app->url('logout');?>" class="nav-item dropdown-item">Log out</a></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">