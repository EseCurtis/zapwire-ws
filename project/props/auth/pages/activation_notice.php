<?php
$user = new User();
?>
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
    <h4 class="mb-2">Activate your account to continue.</h4>

    <p class="mb-4">
      Please check your email for the activation link. <br>
      <!-- div with opacity of 0.7 -->
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
      <strong>Note:</strong> If you do not receive an email, please check your spam folder.
    </div>
    </p>

    <div class="text-center">
      <p>
        <!-- create an info badge -->
        <small>
          Resend mail in:
          <span class="countdown" data-on-time-elapsed="$('#resend-mail').removeAttr('disabled');" data-time="<?= $user->logged_in_user_last_activation_link_request() ?>">
            {time}
          </span>
        </small>
      </p>
    </div>
          
    <form action="amvc.api" api-key="user/auth/resend_activation_link.php" callback="formHandler" method="post" async="true" class="text-center">
      <button type="submit" class="btn btn-primary mb-2" id="resend-mail" disabled>Resend Activation Link</button>
    </form>

    <div class="text-center">
      <a href="<?= $app->url('logout') ?>" class="d-flex align-items-center justify-content-center">
        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
        Sign out
      </a>
    </div>
  </div>
</div>
<!-- /Forgot Password -->