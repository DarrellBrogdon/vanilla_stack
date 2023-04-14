import AbstractView from "./AbstractView.js"
import Nav from './Nav.js'

export default class extends AbstractView {
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