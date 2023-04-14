export default class {
    constructor(params) {
        this.params = params
    }
    
    /**
     * Set the page title
     * 
     * @param {String} title 
     */
    setTitle(title) {
        document.title = title
    }

    /**
     * Load the HTML content for a given page and add it to the DOM at the appropriate place.
     * 
     * @param {String} page 
     */
    async getHtml(page) {
        await fetch(`${window.location.origin}/${page}.php`)
            .then(result => result.text())
            .then(content => document.querySelector('#app').innerHTML = content)
    }

    /**
     * Dynamically bind values to elements
     * 
     * This method binds the value from an object to elements with a `data-key` attribute.
     * 
     * For example; Given the following Object:
     * ```
     * {birtday: '1969-01-01'}
     * ```
     * And the following element:
     * ```
     * <span data-key="birthday"></span>
     * ```
     * 
     * This function will set the `innerHTML` of the `span` element to "1969-01-01".
     * 
     * If the element is an `img` element, then the `src` attribute will be set instead of the `innerHTML` property.
     * 
     * @param {Object} data 
     */
    bindData(data) {
        // Reset image sources
        Array
            .from(document.querySelectorAll(`img[data-key]`))
            .forEach(el => el.src = '')
        
        Object
            .keys(data)
            .forEach(k => {
                const el = document.querySelectorAll(`[data-key="${k}"]`)

                if (el !== null && data[k] !== null) {
                    Array.from(el).forEach(item => {
                        switch (item.nodeName) {
                            case 'IMG':
                                item.src = data[k]
                                break
                            case 'INPUT':
                                switch (item.type) {
                                    case 'radio':
                                        item.checked = data[k]
                                        break;
                                    default:
                                        item.value = data[k]
                                        break;
                                }
                                break
                            default:
                                item.innerHTML = data[k]
                                break
                        }
                    })
                }
            })
    }

    /**
     * Reset all elements with a `data-key` attribute
     */
    resetBoundData() {
        Array
            .from(document.querySelectorAll('[data-key]'))
            .forEach(el => {
                switch (el.nodeName) {
                    case 'IMG':
                        el.src = ''
                        break
                    case 'INPUT':
                        switch (el.type) {
                            case 'radio':
                                el.checked = true
                                break
                            default:
                                el.value = ''
                                break;
                        }
                    default:
                        el.innerHTML = ''
                        break
                }
            })
    }
}