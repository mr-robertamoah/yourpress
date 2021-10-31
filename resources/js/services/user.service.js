import ApiService from "./api.service"
import router from "../routes"
import store from "../storage"
import StorageService from "./storage.service"

const UserService = {
    registerUser: async (data) => {
        return await ApiService.post('/register', data, {mustHaveCookie: true})
            .then(response=>{
                store.dispatch('addUser', response.data.user)
                router.push({name: 'welcome'})
                
                return response
            })
            .catch(error=>{
                throw error
            })
    },
    loginUser: async (data) => {
        return await ApiService.post('/login', data, {mustHaveCookie: true})
            .then(response=>{
                store.dispatch('addUser', response.data.user)
                router.push({name: 'welcome'})
                
                return response
            })
            .catch(error=>{
                throw error
            })
    },
    logoutUser: async (data) => {
        return await ApiService.post('/logout', data, {mustHaveCookie: true})
            .then(response=>{
                store.dispatch('removeUser')
                router.push({name: 'home'})
                
                return response
            })
            .catch(error=>{
                throw error
            })
    },
    getUser: async () => {
        await ApiService.get('/user')
            .then(response=>{
                store.dispatch('addUser', response.data.user)
                
                return response
            })
            .catch(error=>error.response)
    }
}

export default UserService