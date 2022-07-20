<!-- Register -->
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
    <h4 class="mb-2">Welcome to <?= $app->project_info['app_name'] ?>! 👋</h4>
    <p class="mb-4">Please sign-in to your account lets seprate rocket science from websockets togther!</p>

    <form id="formAuthentication" class="login-form" action="amvc.api" api-key="user/auth/sign_in.php" callback="formHandler" method="post" async="true">
      <div class="mb-3">
        <label for="email" class="form-label">Email or Username</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus />
      </div>
      <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
          <label class="form-label" for="password">Password</label>
          <a href="<?= $app->url('password-recovery') ?>">
            <small>Forgot Password?</small>
          </a>
        </div>
        <div class="input-group input-group-merge">
          <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
      </div>
      <!-- <div class="mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="remember-me" />
          <label class="form-check-label" for="remember-me"> Remember Me </label>
        </div>
      </div> -->
      <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
      </div>
    </form>

    <p class="text-center">
      <span>New on our platform?</span>
      <a href="<?= $app->url('sign-up') ?>">
        <span>Create an account</span>
      </a>
    </p>
  </div>
</div>
<!-- /Register -->