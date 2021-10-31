<template>
    <login-register-layout>
        <login-register-card class="relative">
            <Alert
                :message="alertMessage"
                :duration="alertDuration"
                :type="alertType"
                @clearAlert="clearAlert"
            />

            <login-register-form
                heading="login"
                :loading="loading"
                :loadingMsg="'logging in'"
            >
                <form-section>
                    <text-input
                        v-if="!loginWithEmail"
                        id="text-input-1"
                        :autofocus="true"
                        :required="true"
                        label="username"
                        v-model="formData.userName"
                        :notes="[
                            'username can contain a-z,A-Z,0-9 characters',
                            'should be unique and have at least five characters'
                        ]"
                        :errors="formData.userNameErrors"
                    ></text-input>
                    <email-input
                        v-if="loginWithEmail"
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
                        :notes="[
                            'password can contain a-z,A-Z,0-9,_,- characters',
                            'should be have more than 8 characters'
                        ]"
                        :errors="formData.passwordErrors"
                    ></password-input>

                    <checkbox v-model="loginWithEmail"
                        >login with email</checkbox
                    >
                </form-section>
                <div
                    class="flex justify-end w-full items-center mt-10 mb-5 md:w-8/12 mx-auto px-3"
                >
                    <primary-button @click.native="readyData"
                        >login</primary-button
                    >
                </div>
            </login-register-form>

            <div class="w-full text-center text-sm" slot="secondary">
                do you have an account? if no, then
                <router-link
                    class="underline text-blue-400"
                    :to="{ name: 'register' }"
                    >register</router-link
                >
            </div>
        </login-register-card>
    </login-register-layout>
</template>

<script>
import Checkbox from "../components/ui/Checkbox.vue";
import AlertMixin from "../mixins/Alert";
import FormCommons from "../mixins/forms/Common";
import UserService from "../services/user.service";
export default {
    components: {
        Checkbox
    },
    mixins: [AlertMixin, FormCommons],
    beforeRouteEnter(to, from, next) {
        next(vm => {
            if (to.params.message) {
                vm.alertDuration = 5000;
                vm.setSuccessAlert(to.params.message);
            }
        });
    },
    data() {
        return {
            loginWithEmail: false,
            formData: {
                userName: "",
                userNameErrors: [],
                email: "",
                emailErrors: [],
                password: "",
                passwordErrors: []
            }
        };
    },
    methods: {
        readyData() {
            if (this.loading) {
                return;
            }

            if (!this.formData.userName.length && !this.loginWithEmail) {
                this.setError({
                    error: "please you need to add your username to the form",
                    property: "userName"
                });
                return;
            }

            if (!this.formData.email.length && this.loginWithEmail) {
                this.setError({
                    error: "please you need to add your email to the form",
                    property: "email"
                });
                return;
            }

            if (!this.formData.password.length) {
                this.setError({
                    error: "please you need to add your password to the form",
                    property: "password"
                });
                return;
            }

            if (this.formData.password.length < 8) {
                this.setError({
                    error:
                        "please your password must be at least eight characters",
                    property: "password"
                });
                return;
            }

            this.login();
        },
        async login() {
            this.loading = true;

            try {
                await UserService.loginUser({
                    userName: this.formData.userName,
                    email: this.formData.email,
                    password: this.formData.password
                });
            } catch (error) {
                console.log(error, error.response);
                this.setResponseErrors(error.response?.data?.errors);
            } finally {
                this.loading = false;
            }
        }
    }
};
</script>

<style lang="scss" scoped></style>
