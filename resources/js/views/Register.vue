<template>
    <login-register-layout>
        <login-register-card class="relative">
            <Alert 
                :message="alertMessage" 
                :duration="alertDuration" 
                :type="alertType" 
                @clearAlert="clearAlert"/>
                
            <login-register-form 
                heading="register" 
                :totalSections="totalSections" 
                :currentSection="currentSection"
                :loading="loading"
                :loadingMsg="'registering'"
            >
                <template  v-if="currentSection === 1">
                    <form-section>
                        <text-input
                            id="text-input-1"
                            :autofocus="true"
                            :required="true"
                            label="first name"
                            :errors="formData.firstNameErrors"
                            v-model="formData.firstName"
                        ></text-input>
                        <text-input
                            id="text-input-1"
                            :autofocus="false"
                            :required="true"
                            label="last name"
                            :errors="formData.lastNameErrors"
                            v-model="formData.lastName"
                        ></text-input>
                        <text-input
                            id="text-input-1"
                            :autofocus="false"
                            label="other names"
                            :errors="formData.otherNamesErrors"
                            v-model="formData.otherNames"
                        ></text-input>
                    </form-section>
                </template>
                <template  v-if="currentSection === 2">
                    <form-section>
                        <text-input
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
                        <password-input
                            id="password-confirmation-input-1"
                            :required="true"
                            label="password confirmation"
                            v-model="formData.passwordConfirmation"
                            :notes="['should be the same as the password above']"
                            :errors="formData.passwordConfirmationErrors"
                        ></password-input>
                    </form-section>
                </template>
                <div class="flex justify-between w-full items-center mt-10 mb-5 md:w-8/12 mx-auto px-3">
                    <secondary-button 
                        @click.native="clickedButton('next')"
                        v-if="currentSection < totalSections"
                    >next</secondary-button>
                    <secondary-button 
                        @click.native="clickedButton('previous')"
                        v-if="currentSection > 1"
                    >previous</secondary-button>
                    <primary-button
                        v-if="currentSection == totalSections"
                        @click.native="readyData"
                    >register</primary-button>
                </div>
            </login-register-form>

            <div class="w-full text-center text-sm" slot="secondary">
                already have an account? if yes, then <router-link class="underline text-blue-400" :to="{name: 'login'}">login</router-link>
            </div>
        </login-register-card>
    </login-register-layout>
</template>

<script>
import SecondaryButton from '../components/ui/SecondaryButton.vue'
import UserService from '../services/user.service'
import AlertMixin from '../mixins/Alert'
import FormCommons from '../mixins/forms/Common'
    export default {
        components: { 
            SecondaryButton,
        },
        mixins: [AlertMixin, FormCommons],
        data() {
            return {
                currentSection: 1,
                totalSections: 2,
                formData: {
                    firstName: '',
                    firstNameErrors: [],
                    lastName: '',
                    lastNameErrors: [],
                    otherNames: '',
                    otherNamesErrors: [],
                    userName: '',
                    userNameErrors: [],
                    email: '',
                    emailErrors: [],
                    password: '',
                    passwordErrors: [],
                    passwordConfirmation: '',
                    passwordConfirmationErrors: [],
                }
            }
        },
        watch: {
            'formData.firstName'(newValue) {
                this.clearError('firstName')
            },
            'formData.lastName'(newValue) {
                this.clearError('lastName')
            },
            'formData.otherNames'(newValue) {
                this.clearError('otherNames')
            },
            'formData.passwordConfirmation'(newValue) {
                this.clearError('passwordConfirmation')
            }
        },
        methods: {
            clickedButton(text) {
                if (text === 'next') {
                    this.currentSection += 1
                    return
                }

                if (text === 'previous') {
                    this.currentSection -= 1
                    return
                }
            },
            readyData() {
                if (this.loading) {
                    return
                }
                
                if (! this.formData.firstName.length) {
                    this.setError({
                        error: 'please you need to add your first name to the form', 
                        property: 'firstName',
                    })
                    return
                }
                
                if (! this.formData.lastName.length) {
                    this.setError({
                        error: 'please you need to add your last name to the form', 
                        property: 'lastName',
                    })
                    return
                }
                
                if (! this.formData.userName.length) {
                    this.setError({
                        error: 'please you need to add your username to the form', 
                        property: 'userName',
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
                
                if (this.formData.password.trim() !== this.formData.passwordConfirmation.trim()) {
                    this.setError({
                        error: 'please the password confirmation must match the password', 
                        property: 'passwordConfirmation',
                    })
                    return
                }
                
                if (! this.formData.passwordConfirmation.length) {
                    this.setError({
                        error: 'please you need to add your password confirmation to the form', 
                        property: 'passwordConfirmation',
                    })
                    return
                }

                this.register()
            },
            setCurrentSection(property) {
                let section = this.getSection(property)

                if (this.currentSection !== section && section === 1) {
                    this.currentSection = section
                }
            },
            async register() {

                this.loading = true

                try {
                    await UserService.registerUser({
                        'firstName': this.formData.firstName,
                        'lastName': this.formData.lastName,
                        'otherNames': this.formData.otherNames,
                        'userName': this.formData.userName,
                        'email': this.formData.email,
                        'password': this.formData.password,
                        'password_confirmation': this.formData.passwordConfirmation
                    })
                } catch (error) {
                    
                    this.setResponseErrors(error.response.data.errors)
                } finally {
                    this.loading = false
                }
            },
            getSection(property) {
                if (['firstName', 'lastName', 'otherNames'].includes(property)) {
                    return 1
                }

                return 2
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>