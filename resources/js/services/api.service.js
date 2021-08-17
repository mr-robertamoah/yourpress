import axios from "axios"
import cookie from 'js-cookie'

const ApiService = {
    mount() {
        axios.interceptors()
    },
    async get(url, config = null) {
        await this.getCSRFCookie(config)
        
        return axios.get(url, config)
    },
    getCSRFCookie(config) {
        if (! config?.mustHaveCookie || cookie.get('laravel_session')) {
            return
        }

        return this.get('/csrf-cookie')
    },
    async post(url, data, config = null) {
        await this.getCSRFCookie(config)

        return axios.post(url, data, config)
    },

}

export default ApiService