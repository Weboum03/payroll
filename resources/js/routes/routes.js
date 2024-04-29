import Cookies from "js-cookie";
import store from "../store";

const AuthenticatedLayout = () => import("../layouts/Authenticated.vue");
const GuestLayout = () => import("../layouts/Guest.vue");

function requireLogin(to, from, next) {
    let isLogin = false;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next();
    } else {
        next("/login");
    }
}

function guest(to, from, next) {
    let isLogin;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next("/");
    } else {
        next();
    }
}

export default [
    {
        path: "/",
        // redirect: { name: 'login' },
        component: GuestLayout,
        children: [
            {
                path: "/",
                name: "home",
                component: () => import("../views/home/index.vue"),
            },
            {
                path: "posts",
                name: "public-posts.index",
                component: () => import("../views/posts/index.vue"),
            },
            {
                path: "posts/:id",
                name: "public-posts.details",
                component: () => import("../views/posts/details.vue"),
            },
            {
                path: "category/:id",
                name: "category-posts.index",
                component: () => import("../views/category/posts.vue"),
            },
            {
                path: "login",
                name: "auth.login",
                component: () => import("../views/login/Login.vue"),
                beforeEnter: guest,
            },
            {
                path: "register",
                name: "auth.register",
                component: () => import("../views/register/index.vue"),
                beforeEnter: guest,
            },
            {
                path: "forgot-password",
                name: "auth.forgot-password",
                component: () => import("../views/auth/passwords/Email.vue"),
                beforeEnter: guest,
            },
            {
                path: "reset-password/:token",
                name: "auth.reset-password",
                component: () => import("../views/auth/passwords/Reset.vue"),
                beforeEnter: guest,
            },
        ],
    },
    {
        path: "/admin",
        component: AuthenticatedLayout,
        // redirect: {
        //     name: 'admin.index'
        // },
        beforeEnter: requireLogin,
        children: [
            {
                name: "admin.index",
                path: "",
                component: () => import("../views/admin/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.home",
                path: "",
                component: () => import("../views/admin/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.dashboard",
                path: "dashboard",
                component: () => import("../views/admin/dashboard/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.onBoard",
                path: "onBoard",
                component: () => import("../views/admin/onBoard/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.approvals",
                path: "approvals",
                component: () => import("../views/admin/approval/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.approvalHistory",
                path: "approval/history",
                component: () => import("../views/admin/approval/history.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.payroll",
                path: "payroll",
                component: () => import("../views/admin/payroll/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
        ],
    },
    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
        component: () => import("../views/errors/404.vue"),
    },
];
