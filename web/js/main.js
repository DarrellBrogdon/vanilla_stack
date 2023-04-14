
import Login from './Login.js'
import Home from './Home.js'
import Account from './Account.js'
import About from './About.js'
import PasswordReset from './PasswordReset.js'
import CreateProfile from './CreateProfile.js'

/**
 * Get the value of a specified cookie name.
 * 
 * If the cookie isn't found then returns false.
 * 
 * @param {String} name The name of the cookie to get
 * @returns String | false
 */
window.getCookie = name => {
    name = name + '='

    // Get the decoded cookie
    const decodedCookie = decodeURIComponent(document.cookie)

    // Get all cookies by splitting on the semicolon
    const cookies = decodedCookie.split(';')

    // Loop over the cookies
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim()
        
        // If this cookie has the name of what we are searching, then return its value
        if (cookie.indexOf(name) == 0) {
            return cookie.substring(name.length, cookie.length)
        }
    }

    return false
}

const pathToRegex = path => new RegExp("^" + path.replace(/\//g, "\\/").replace(/:\w+/g, "(.+)") + "$")

window.router = async () => {
    const routes = [
        {view: Login},
        {view: Home},
        {view: Account},
        {view: About},
        {view: PasswordReset},
        {view: CreateProfile},
    ]

    const potentialMatches = routes.map(route => {
        return {
            route,
            result: location.pathname.match(pathToRegex(route.view.path))
        }
    })

    let match = potentialMatches.find(potentialMatch => potentialMatch.result !== null)

    // If one of the following conditions are present then return the first route (Login):
    //   1. Route not found 
    //   2. No cookie was found AND the page requested doesn't require authentication to access
    //      e.g.; Login, PasswordReset, etc...
    if (!match || (!getCookie('authentication_token') && match.route.view.authRequired)) {
        match = {
            route: routes[0],
            result: [location.pathname]
        }
    }

    await new match.route.view(getParams(match)).getHtml()
}

/**
 * navigateTo()
 * 
 * Navigate to a specified URL.
 * 
 * @param {String} url The URL to navigate to
 */
window.navigateTo = url => {
    history.pushState(null, null, url)
    router()
}

const getParams = match => {
    const values = match.result.slice(1)
    const keys = Array.from(match.route.view.path.matchAll(/:(\w+)/g))

    return Object.fromEntries(keys.map((key, i) => {
        return [key, values[i]]
    }))
}

document.addEventListener('DOMContentLoaded', async () => await router())

window.addEventListener('popstate', router)