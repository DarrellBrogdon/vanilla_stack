import AbstractView from "./AbstractView.js"

export default class extends AbstractView {
    page = 'Create Profile'

    constructor(params) {
        super(params)
        this.setTitle(this.page)
    }
    
    async getHtml() {
        await super.getHtml('create_profile')
        this.watchResetForm()
    }

    watchResetForm() {
        const form = document.querySelector('.needs-validation')
        
        form.addEventListener('submit', event => {
            event.preventDefault()

            if (!form.checkValidity()) {
                event.stopPropagation()
            } else {
                navigateTo('/login')
            }

            form.classList.add('was-validated')
        }, false)
    }
}