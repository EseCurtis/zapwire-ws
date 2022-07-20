<?php
$stat = new Stat();
?>
<div class="row">
    <!-- simple form for picking any year and set action to same page with year input to have name 'y' -->
    <form action="<?= $app->url('admin-board/home') ?>" method="GET">
      <div class="input-group text-right">
        <input type="year" class="form-control" name="y" value="<?= $_data['current_year'] ?>" placeholder="Year">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Go</button>
        </div>
      </div>
    </form>
</div>
<!-- bootstrap element with everything aligned right -->

<div class="row">
  <div class="col-lg-4">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">Total Signups</h5>
        <h3 class="card-title">
          <i class="tim-icons icon-pencil text-primary"></i>
          <?= $stat->get_total('users', $_data["current_year"]); ?>
        </h3>
      </div>
      <div class="card-body">
        <div class="chart-area">
          <canvas id="chartLinePurple"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">Activity Based on Logs</h5>
        <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> <?= $stat->get_total('logs', $_data["current_year"]); ?></h3>
      </div>
      <div class="card-body">
        <div class="chart-area">
          <canvas id="chartLineOrange"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">Channels Created</h5>
        <h3 class="card-title"><i class="tim-icons icon-send text-success"></i> <?= $stat->get_total('channels', $_data["current_year"]); ?></h3>
      </div>
      <div class="card-body">
        <div class="chart-area">
          <canvas id="chartLineGreen"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>