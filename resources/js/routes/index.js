import VueRouter from "vue-router";
import Vue from "vue";

import routes from "./routes";
import {routerBeforeEach} from "./router";

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes,
})

router.beforeEach((to, from, next) => routerBeforeEach(to, from, next))

export default router