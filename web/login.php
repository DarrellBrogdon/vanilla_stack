<div class="row" style="height:775px; margin:100px auto;">
    <div class="col h-100 d-flex align-items-center justify-content-center">
        <form method="post" id="login_form" class="needs-validation w-25" novalidate>
            <h1 class="mt-5">Welcome</h1>
            <div class="input-group has-validation mb-4">
                <div class="col-md-12">
                    <input type="email" 
                           name="email" 
                           id="email" 
                           class="form-control input-field" 
                           aria-describedby="emailHelp" 
                           placeholder="Email Address"
                           required />
                    <div class="invalid-feedback">Please choose a valid email address</div>
                </div>
            </div>
            <div class="input-group has-validation">
                <div class="col-md-12">
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control input-field" 
                           aria-describedby="passwordHelp" 
                           placeholder="Password"
                           required />
                    <div class="invalid-feedback">Please choose a valid password</div>
                </div>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col text-end">
                    <a href="/password-reset" class="fw-light" style="font-size:0.80em;">Forgot password?</a>
                </div>
            </div>
            <div class="row ms-1 me-1">
                <button type="submit" class="btn btn-primary" id="login-button">
                    <span class="spinner-border spinner-border-sm button-spinner"
                          role="status"
                          aria-hidden="true"
                          id="login-spinner"></span>
                    <span id="login-text">Log In</span>
                </button>
            </div>
            <div class="row mt-3">
                <a href="/create-profile" class="ps-3 pe-3">
                    <button type="button" class="btn btn-secondary w-100" id="create-profile-button">Create Profile</button>
                </a>
            </div>
        </form>
    </div>
</div>

<div id="badLoginAlert" class="modal fade" tabindex="-1" aria-labelledby="badLoginAlertLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="badLoginAlertHeader">Invalid Login!</h5>
            </div>
            <div class="modal-body">
                <p>Please check your credentials and try logging in again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>