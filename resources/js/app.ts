/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import router from "./routes";
const { default: ApiService } = require("./services/api.service");
const { default: UserService } = require("./services/user.service");
import store from "./storage";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import { createApp } from "vue";

library.add(faEye, faEyeSlash);

require("./bootstrap");

export const AppConstants = {
    //get this from the server later
    apiServices: {
        nonRedirectables: [
            "login",
            "register",
            "home",
            "dashboard",
            "testing",
            "profile",
        ],
    },
};

const app = createApp({
    async created() {
        ApiService.mountResponseInterceptor();

        await UserService.getUser();
    },
});

app.use(router)
    .use(store)

    .component("main-app", require("./components/MainApp.vue").default)

    .mount("#app");
