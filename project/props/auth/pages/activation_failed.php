<!-- Forgot Password -->
<div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo" style="height:25px;">
                 <img src="<?= $app->url($app->project_info['logos']['z2']) ?>" alt="<?= $app->url($app->project_info['app_name']) ?>" height="100%" />

                  </span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Activation Failed!</h4>
              <p class="mb-4">Try refreshing the page. <br> If it does not work, You can contact our technical support</p>
              
              <div class="text-center">
                <a href="<?=$app->url('technical-support')?>" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Technical Support
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->