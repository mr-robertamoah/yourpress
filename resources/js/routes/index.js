import { createRouter, createWebHistory } from "vue-router";

import routes from "./routes";
import { routerBeforeEach } from "./router";

const router = createRouter({
    mode: "history",
    routes,
    history: createWebHistory(),
});

router.beforeEach((to, from, next) => routerBeforeEach(to, from, next));

export default router;
