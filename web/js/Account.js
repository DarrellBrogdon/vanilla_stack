import AbstractView from "./AbstractView.js"
import Nav from './Nav.js'

export default class extends AbstractView {
    page = 'Account'
    
    constructor(params) {
        super(params)
        this.setTitle(this.page)
    }

    async getHtml() {
        await super.getHtml(this.page.toLowerCase())
        new Nav('account')

        fetch('/api/1.0/account', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer abc123',
            },
        })
        .then(response => response.json())
        .then(data => this.bindData(data.response))
    }
}