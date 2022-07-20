<!-- Forgot Password -->
<div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo" style="height:25px;">
                  <img src="<?=$app->url($app->project_info['logos']['z2'])?>" alt="Zapwire" height="100%"/>

                  </span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Reset Password 🔒</h4>
              <p class="mb-4">Reset your password to a new one you can remember.</p>
              <form id="formAuthentication"class="login-form" action="amvc.api" api-key="user/auth/password_reset.php" callback="formHandler" method="post" async="true">
                <!-- new password and repeat password and a hidden input that carries the recovery token  -->
                
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="repeat_password">Repeat Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="repeat_password"
                      class="form-control"
                      name="repeat_password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <input type="hidden" name="recovery_token" value="<?=$_data['token']?>">

                <button class="btn btn-primary d-grid w-100">Reset Password</button>
              </form>
            </div>
          </div>
          <!-- /Forgot Password -->