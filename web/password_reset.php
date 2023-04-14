<div class="row" style="height:775px; margin:100px auto;">
    <div class="col h-100 d-flex align-items-center justify-content-center" id="right-col">
        <form method="post" id="reset_form" class="needs-validation w-25" novalidate>
            <h1 class="mt-5">Reset Password</h1>
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
            <div class="row ms-1 me-1" id="reset-row">
                <button type="submit" class="btn btn-primary" id="reset-button">
                    <span class="spinner-border spinner-border-sm button-spinner"
                          role="status"
                          aria-hidden="true"
                          id="submit-spinner"></span>
                    <span id="submit-text">Submit</span>
                </button>
            </div>
            <div class="row mt-3">
                <a href="/" class="ps-3 pe-3">
                    <button type="button" class="btn btn-secondary w-100" id="create-profile-button">Cancel</button>
                </a>
            </div>
        </form>
    </div>
</div>

<div id="passwordResetSentAlert" class="modal fade" tabindex="-1" aria-labelledby="passwordResetSentAlertLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="badPasswordResetAlertHeader">Password Reset Sent</h5>
            </div>
            <div class="modal-body">
                <p>Please check your email for instructions on resetting your password.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>