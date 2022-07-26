<div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> General </a>
                    </li>
                  </ul>
                </div>  <!-- /.row -->
                  
                  <!-- change password card -->
                  <div class="card mb-3">
                    <div class="card-header">
                      <h4 class="card-title">Change Password</h4>

                    </div>
                    <div class="card-body">
                      <!-- use amvc async form -->

                      <form class="form-horizontal" action="amvc.api" api-key="settings/change_password.php" callback="formHandler" method="post" async="true">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input
                              type="password"
                              class="form-control"
                              id="currentPassword"
                              name="currentPassword"
                              placeholder="Current Password"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input
                              type="password"
                              class="form-control"
                              id="newPassword"
                              name="newPassword"
                              placeholder="New Password"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input
                              type="password"
                              class="form-control"
                              id="confirmPassword"
                              name="confirmPassword"
                              placeholder="Confirm Password"
                            />
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <br>

                  <!-- delete account -->
                  <div class="card">
                    <h5 class="card-header">Deactivate Account</h5>
                    <div class="card-body">
                      <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                          <h6 class="alert-heading fw-bold mb-1">Are you sure you want to Deactivate your account?</h6>
                          <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                        </div>
                      </div>
                      <form id="formAccountDeactivation"action="amvc.api" api-key="settings/deactivate_account.php" callback="formHandler" method="post" async="true">
                        <div class="form-check mb-3">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            value="1"
                            name="authorized"
                          />
                          <label class="form-check-label" for="accountActivation"
                            >I confirm my account deactivation</label
                          >
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>