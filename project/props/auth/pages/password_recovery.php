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
              <h4 class="mb-2">Forgot Password? 🔒</h4>
              <p class="mb-4">Enter your email and we'll send you your recovery link Asap!</p>
              <form id="formAuthentication"class="login-form" action="amvc.api" api-key="user/auth/password_recovery.php" callback="formHandler" method="post" async="true">
                <!-- email -->
                <div class="mb-3">
                  <label class="form-label" for="email">Email</label>
                  <input
                    type="email"
                    id="email"
                    class="form-control"
                    name="email"
                    placeholder="Enter your email"
                    aria-describedby="email"
                  />
                </div>
                <!-- /email -->

                <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
              </form>
              <div class="text-center">
                <a href="<?=$app->url('sign-in')?>" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Back to Login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->