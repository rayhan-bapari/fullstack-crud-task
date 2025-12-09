import { createRouter, createWebHistory } from "vue-router";

import Login from "@/pages/login.vue";
import Dashboard from "@/pages/Dashboard.vue";

const routes = [
    {
        path: "/login",
        component: Login,
        meta: { guest: true },
    },
    {
        path: "/dashboard",
        component: Dashboard,
        meta: { requiresAuth: true },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const user = localStorage.getItem("user");

    if (to.meta.requiresAuth && !user) {
        next("/login");
    } else if (to.meta.guest && user) {
        next("/dashboard");
    } else {
        next();
    }
});

export default router;
