import ApiService from "./api.service"
import router from "../routes"
import store from "../storage"

const UserService = {
    registerUser: async (data) => {
        return await ApiService.post('/register', data, {mustHaveCookie: true})
            .then(response=>{
                store.dispatch('addUser', response.data.user)
                router.push({name: 'welcome'})
            })
    },
    loginUser: async (data) => {
        return await ApiService.post('/login', data, {mustHaveCookie: true})
            .then(response=>{
                store.dispatch('addUser', response.data.user)
                router.push({name: 'welcome'})
            })
    },
    logoutUser: async (data) => {
        return await ApiService.post('/logout', data, {mustHaveCookie: true})
            .then(response=>{
                store.dispatch('removeUser')
                router.push({name: 'home'})
            })
    },
    getUser: async (data) => {
        await ApiService.post('/register', data, {mustHaveCookie: true})
            .then(response=>{
                store.dispatch('addUser', response.data.user)
            })
    }
}

export default UserService