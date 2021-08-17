<template>
    <login-register-layout>
        <login-register-card class="relative">
            <Alert :message="alertMessage" :type="alertType" @clearAlert="clearAlert"/>
            <login-register-form 
                heading="login"
                :loading="loading"
                :loadingMsg="'logging in'"
            >
                <form-section>
                    <text-input
                        v-if="loginWith === 'username'"
                        id="text-input-1"
                        :autofocus="true"
                        :required="true"
                        label="username"
                        v-model="formData.userName"
                        :notes="['username can contain a-z,A-Z,0-9 characters',
                            'should be unique and have at least five characters']"
                        :errors="formData.userNameErrors"
                    ></text-input>
                    <email-input
                        v-if="loginWith === 'email'"
                        id="email-input-1"
                        label="email"
                        v-model="formData.email"
                        :notes="['should be a valid email']"
                        :errors="formData.emailErrors"
                    ></email-input>
                    <password-input
                        id="password-input-1"
                        :required="true"
                        label="password"
                        v-model="formData.password"
                        :notes="['password can contain a-z,A-Z,0-9,_,- characters',
                            'should be have more than 8 characters']"
                        :errors="formData.passwordErrors"
                    ></password-input>
                </form-section>
                <div class="flex justify-end w-full items-center mt-10 mb-5 md:w-8/12 mx-auto px-3">
                    <primary-button
                        @click.native="readyData"
                    >login</primary-button>
                </div>
            </login-register-form>

            <div class="w-full text-center text-sm" slot="secondary">
                do you have an account? if no, then <router-link class="underline text-blue-400" :to="{name: 'register'}">register</router-link>
            </div>
        </login-register-card>
    </login-register-layout>
</template>

<script>
import FormSection from '../components/layouts/FormSection.vue'
import LoginRegisterCard from '../components/login/LoginRegisterCard.vue'
import LoginRegisterForm from '../components/login/LoginRegisterForm.vue'
import LoginRegisterLayout from '../components/login/LoginRegisterLayout.vue'
import EmailInput from '../components/ui/EmailInput.vue'
import PasswordInput from '../components/ui/PasswordInput.vue'
import PrimaryButton from '../components/ui/PrimaryButton.vue'
import TextInput from '../components/ui/TextInput.vue'
import AlertMixin from '../mixins/Alert'
import UserService from '../services/user.service'
    export default {
        components: {
            LoginRegisterLayout,
            LoginRegisterForm,
            LoginRegisterCard,
            TextInput,
            FormSection,
            EmailInput,
            PasswordInput,
            PrimaryButton,
        },
        mixins: [AlertMixin],
        data() {
            return {
                loading: false,
                loginWith: 'username',
                formData: {
                    userName: '',
                    userNameErrors: [],
                    email: '',
                    emailErrors: [],
                    password: '',
                    passwordErrors: [],
                }
            }
        },
        methods: {
            readyData() {
                if (this.loading) {
                    return
                }
                
                if (! this.formData.userName.length && this.loginWith === 'username') {
                    this.setError({
                        error: 'please you need to add your username to the form', 
                        property: 'userName',
                    })
                    return
                }
                
                if (! this.formData.email.length && this.loginWith === 'email') {
                    this.setError({
                        error: 'please you need to add your email to the form', 
                        property: 'email',
                    })
                    return
                }
                
                if (! this.formData.password.length) {
                    this.setError({
                        error: 'please you need to add your password to the form', 
                        property: 'password',
                    })
                    return
                }
                
                if (this.formData.password.length < 8) {
                    this.setError({
                        error: 'please your password must be at least eight characters', 
                        property: 'password',
                    })
                    return
                }

                this.login()
            },
            setError({error, property, errors}) {
                
                let propertyError = `${property}Errors`

                if (! this.formData.hasOwnProperty(propertyError)) {
                    return
                }

                if (error) {
                    this.formData[propertyError].unshift(error)
                }

                if (errors?.length) {
                    this.formData[propertyError] = [...errors]
                }
            },
            clearError(property) {
                let propertyError = `${property}Errors`
                if (! this.formData[propertyError]?.length) {
                    return
                }

                this.formData[propertyError] = []
            },
            async login() {

                this.loading = true

                try {
                    let response = await UserService.loginUser({
                        'userName': this.formData.userName,
                        'email': this.formData.email,
                        'password': this.formData.password,
                    })

                    if (response.status !== 200) {
                        
                        return
                    }

                } catch (error) {
                    
                    console.log(error, error.response);
                    this.setResponseErrors(error.response?.data?.errors)
                } finally {
                    this.loading = false
                }
            },
            setResponseErrors(errors) {
                if (! errors) {
                    this.setDangerAlert("oops 😕! something happened. please try again in a few minutes time")
                    return
                }

                let property
                for (const errorName in errors) {
                    property = errorName

                    if (property === 'username') {
                        property = 'userName'
                    }

                    this.setError({
                        errors: errors[property],
                        property,
                    })
                }
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>