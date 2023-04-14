<div class="row" style="height:775px; margin:100px auto;">
    <div class="col h-100 d-flex align-items-center justify-content-center" id="right-col">
        <form method="post" id="create_profile_form" class="needs-validation w-25" novalidate>
            <h1 class="mt-5">Create Profile</h1>
            <div class="input-group has-validation mt-2">
                <div class="col-md-12">
                    <input type="text" 
                           name="email-address" 
                           id="email-address" 
                           class="form-control input-field" 
                           aria-describedby="emailAddressHelp" 
                           placeholder="Email Address"
                           required />
                    <div class="invalid-feedback">Please choose a valid email address</div>
                </div>
            </div>
            <div class="input-group has-validation mt-2">
                <input type="password" 
                       name="create_password" 
                       id="create_password" 
                       class="form-control input-field" 
                       aria-describedby="createPasswordHelp" 
                       placeholder="Password"
                       required />
                <div class="invalid-feedback">Please choose a valid password</div>
            </div>
            <div class="input-group has-validation mt-2 mb-4">
                <input type="password" 
                       name="confirm_password" 
                       id="confirm_password" 
                       class="form-control input-field" 
                       aria-describedby="confirmPasswordHelp" 
                       placeholder="Confirm Password"
                       required />
                <div class="invalid-feedback">Please choose a matching password</div>
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

<div id="createProfileSentAlert" class="modal fade" tabindex="-1" aria-labelledby="createProfileSentAlertLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="badCreateProfileSentAlertHeader">Profile Created</h5>
            </div>
            <div class="modal-body">
                <p>Please check your email for instructions on logging in.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>