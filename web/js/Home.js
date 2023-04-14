import AbstractView from "./AbstractView.js"
import Nav from './Nav.js'

export default class extends AbstractView {
    static path = '/home'
    static authRequired = true

    page = 'Home'
    
    constructor(params) {
        super(params)
        this.setTitle(this.page)
    }

    async getHtml() {
        await super.getHtml(this.page.toLowerCase())
        new Nav('home')
    }
}