import AbstractView from "./AbstractView.js"

export default class extends AbstractView {
    pageName = ''

    constructor(pageName) {
        super()
        this.pageName = pageName
        this.init()
    }

    async init() {
        await super.getComponent('nav', '#nav')
        document.getElementById(`${this.pageName}-nav-link`).classList.add('active')
    }
}