<?php
$count = $_data['count'];
$label = $_data['label'];
$icon = $_data['icon'];
$icon_theme = $_data['icon_theme'];
?>
<div class="col-sm-3" style="box-shadow:none;">
  <div class="cardx">
    <div class="card-body">
      <div class="card-title d-flex align-items-start justify-content-between">
        <div class="avatar flex-shrink-0">
          <!-- include box-icon using span  -->
          <span class="avatar-title rounded-circle" style="
                              
                              background: <?= $icon_theme . "50" ?>;
                              color: <?= $icon_theme ?>;
                              display: flex;
                              align-items: center;
                              justify-content: center;
                                padding: 1.2em;
                              ">
            <i class="<?= $icon ?>" style="
                                /* 40px font */
                                font-size: 40px;
                                /* set line height to make icon an even height with width */
                                line-height: 0.2;
                                margin: 0;
                                "></i>

          </span>

        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-dots-vertical-rounded"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
            <a class="dropdown-item" href="<?=$app->url($_data['route_to'])?>" async="true">See Breakdown</a>
          </div>
        </div>
      </div>
      <span class="fw-semibold d-block mb-1"><?= $label ?></span>
      <h3 class="card-title mb-2 o-count"><?= $count ?></h3>
      <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>The past 7 days</small>
    </div>
  </div>
</div>