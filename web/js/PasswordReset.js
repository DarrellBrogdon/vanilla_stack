import AbstractView from "./AbstractView.js"

export default class extends AbstractView {
    static path = '/password-reset'
    static authRequired = false

    page = 'Password Reset'

    constructor(params) {
        super(params)
        this.setTitle(this.page)
    }
    
    async getHtml() {
        await super.getHtml('password_reset')
        this.watchResetForm()
    }

    watchResetForm() {
        const form = document.querySelector('.needs-validation')
        
        form.addEventListener('submit', event => {
            event.preventDefault()

            if (!form.checkValidity()) {
                event.stopPropagation()
            } else {
                fetch('/api/1.0/reset_password', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({email: document.getElementById('email').value})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.response.success) {
                        const alertModal = new bootstrap.Modal('#passwordResetSentAlert', {})
                        alertModal.show()
                    }
                })
            }

            form.classList.add('was-validated')
        }, false)
    }
}