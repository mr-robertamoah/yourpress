<template>
    <header class="flex p-3 justify-between items-center border-b-2 border-green-300 bg-white">
        <div class="font-black text-2xl tracking-wider cursor-pointer" @click="clickedLogo">YourPress</div>
        <div class="">
            <router-link 
                class="router-link-class" 
                v-if="$route.name !== 'dashboard'" 
                :to="{name: 'dashboard'}"
            >dashboard</router-link>

            <router-link 
                class="router-link-class" 
                v-if="$route.name !== 'register' && !isLoggedIn" 
                :to="{name: 'register'}"
            >register</router-link>
            <router-link
                class="router-link-class" 
                v-if="$route.name !== 'login' && !isLoggedIn" 
                :to="{name: 'login'}"
            >login</router-link>
            <div 
                class="router-link-class cursor-default" 
                v-if="isLoggedIn" 
                @click="logout"
            >{{loading ? 'logging out...' : `logout`}}</div>
        </div>
    </header>
</template>

<script>
import { mapGetters } from 'vuex'
import UserService from '../../services/user.service'
    export default {
        data() {
            return {
                loading: false
            }
        },
        computed: {
            ...mapGetters(['getUser']),
            isLoggedIn() {
                return Boolean(this.getUser) 
            }
        },
        methods: {
            async logout() {
                this.loading = true

                try {
                    await UserService.logoutUser()
                } catch (error) {
                    console.log(`error`, error, error.response)
                } finally {
                    this.loading = false
                }
            },
            clickedLogo() {
                if (this.$route.name === 'home') {
                    return
                }

                this.$router.push({name: 'home'})
            },
        },
    }
</script>

<style lang="scss" scoped>
    
</style>