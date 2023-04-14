import AbstractView from "./AbstractView.js"

export default class extends AbstractView {
    page = 'Login'
    
    constructor(params) {
        super(params)
        this.setTitle(this.page)
    }
    
    async getHtml() {
        await super.getHtml(this.page.toLowerCase())
        this.watchLogin()
    }

    watchLogin() {
        const form = document.querySelector('.needs-validation')
        
        form.addEventListener('submit', event => {
            event.preventDefault()

            if (!form.checkValidity()) {
                event.stopPropagation()
            } else {
                this.setLoginButton(true, 'Logging In...')

                fetch('/api/1.0/auth', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        password: document.getElementById('password').value
                    })
                })
                .then(response => {
                    if (response.status !== 200) {
                        const alertModal = new bootstrap.Modal('#badLoginAlert', {})
                        alertModal.show()
                        this.setLoginButton(false, 'Log In')
                    } else {
                        return response.json()
                    }
                })
                .then(data => {
                    document.cookie = `name=${data.response.name}`
                    document.cookie = `authentication_token=${data.response.authentication_token}`
                    document.cookie = `user_id=${data.response.id}`
                    document.cookie = `email=${document.getElementById('email').value}`

                    // Use "window.lcoation.href" here instead of "navigateTo" because we need to force a page refresh 
                    // which allows PHP to see that the cookies have been set.
                    window.location.href = '/home'
                })
                .catch(error => {
                    const alertModal = new bootstrap.Modal('#badLoginAlert', {})
                    alertModal.show()
                    this.setLoginButton(false, 'Log In')
                })
            }

            form.classList.add('was-validated')
        }, false)
    }

    setLoginButton(display, text) {
        document.getElementById('login-spinner').style.display = display ? 'inline-block': 'none'
        document.getElementById('login-text').textContent = text
    }
}