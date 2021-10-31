
const routes = [
    {
        name: 'home',
        path: '/',
        component: () => import(/* webpackChunkName: 'Home' */ '../views/Home.vue'),
    },
    {
        name: 'login',
        path: '/login',
        component: () => import(/* webpackChunkName: 'Login' */ '../views/Login.vue'),
    },
    {
        name: 'register',
        path: '/register',
        component: () => import(/* webpackChunkName: 'Register' */ '../views/Register.vue'),
    },
    {
        name: 'welcome',
        path: '/welcome',
        component: () => import(/* webpackChunkName: 'Welcome' */ '../views/Welcome.vue'),
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: () => import(/* webpackChunkName: 'Dashboard' */ '../views/Dashboard.vue'),
    },
    {
        name: 'testing',
        path: '/testing',
        component: () => import(/* webpackChunkName: 'Testing' */ '../views/Testing.vue'),
    },
    {
        name: 'projects',
        path: '/projects',
        component: () => import(/* webpackChunkName: 'Project' */ "../views/Project.vue"),
    },
    {
        name: 'profile',
        path: 'profile/:type/:id',
        component: () => import(/* webpackChunkName: 'Profile' */ "../views/Profile.vue"),
    },
    {
        name: 'notFound',
        path: '/404',
        component: () => import(/* webpackChunkName: 'Home' */ '../views/Home.vue'),
        alias: '*'
    },
]

export default routes