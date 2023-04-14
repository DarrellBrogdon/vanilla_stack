import AbstractView from "./AbstractView.js"
import Nav from './Nav.js'

export default class extends AbstractView {
    static path = '/about'
    static authRequired = true

    page = 'About'
    
    constructor(params, data) {
        super(params)
        this.setTitle(this.page)
    }

    async getHtml() {
        await super.getHtml(this.page.toLowerCase())
        new Nav('about')
    }
}