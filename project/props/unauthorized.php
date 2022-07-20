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
              <h4 class="mb-2">Sorry, Unauthorized Access.</h4>
              <p class="mb-4">
                The page you are trying to access is not accessible to users of your role.
              </p>
              
              <div class="text-center">
                <a href="javascript:void(0)" onclick="history.back()" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Go back
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->