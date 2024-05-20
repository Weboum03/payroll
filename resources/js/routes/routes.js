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
        next("/admin");
    } else {
        next("/login");
    }
}

export default [
    {
        path: "/",
        // redirect: { name: 'login' },
        // beforeEnter: guest,
        component: GuestLayout,
        children: [
            {
                path: "/",
                name: "home",
                component: () => import("../views/home/index.vue"),
                beforeEnter: guest,
            },
            {
                path: "posts",
                name: "public-posts.index",
                component: () => import("../views/posts/index.vue"),
                beforeEnter: guest,
            },
            {
                path: "posts/:id",
                name: "public-posts.details",
                component: () => import("../views/posts/details.vue"),
                beforeEnter: guest,
            },
            {
                path: "category/:id",
                name: "category-posts.index",
                component: () => import("../views/category/posts.vue"),
                beforeEnter: guest,
            },
            {
                path: "login",
                name: "auth.login",
                component: () => import("../views/login/Login.vue"),
            },
            {
                path: "register",
                name: "auth.register",
                component: () => import("../views/register/index.vue"),
            },
            {
                path: "forgot-password",
                name: "auth.forgot-password",
                component: () => import("../views/auth/passwords/Forgetpassword.vue"),
            },
            // {
            //     path: "forgot-password",
            //     name: "auth.forgot-password",
            //     component: () => import("../views/auth/passwords/Email.vue"),
            //     beforeEnter: guest,
            // },
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
                component: () => import("../views/admin/home/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.home",
                path: "home",
                component: () => import("../views/admin/home/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.dashboard",
                path: "dashboard",
                component: () => import("../views/admin/dashboard/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.dashboard1",
                path: "dashboard1",
                component: () => import("../views/admin/dashboard/index1.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.dashboard2",
                path: "dashboard2",
                component: () => import("../views/admin/dashboard/index2.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.MonthsCompareTable",
                path: "MonthsCompareTable",
                component: () => import("../views/admin/dashboard/MonthsCompareTable.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.FinancialYearCompareTable",
                path: "FinancialYearCompareTable",
                component: () => import("../views/admin/dashboard/FinancialYearCompareTable.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.PayrollBatchform",
                path: "PayrollBatchform",
                component: () => import("../views/admin/payroll/PayrollBatchform.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.PayrollBatchList",
                path: "PayrollBatchList",
                component: () => import("../views/admin/payroll/PayrollBatchList.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.PayrollprocessList",
                path: "PayrollprocessList",
                component: () => import("../views/admin/payroll/PayrollprocessList.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.PayrollAdjustment",
                path: "PayrollAdjustment",
                component: () => import("../views/admin/payroll/PayrollAdjustment.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.PayrollBatchProcess",
                path: "PayrollBatchProcess",
                component: () => import("../views/admin/payroll/PayrollBatchProcess.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.EmpProfile",
                path: "EmpProfile/:id",
                component: () => import("../views/admin/profile/EmpProfile.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.EditProfile",
                path: "EditProfile/:id",
                component: () => import("../views/admin/profile/EditProfile.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.planner",
                path: "planner",
                component: () => import("../views/admin/profile/planner.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.onBoard",
                path: "onBoard",
                component: () => import("../views/admin/onBoard/index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.deBoard",
                path: "deBoard/:id",
                component: () => import("../views/admin/DeBoard/index.vue"),
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
            {
                name: "admin.users",
                path: "users",
                component: () => import("../views/admin/users/Index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.EmployeeRole",
                path: "EmployeeRole",
                component: () => import("../views/admin/employee/Index.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.EmployeeRoleEdit",
                path: "EmployeeRoleEdit/:id",
                component: () => import("../views/admin/employee/Edit.vue"),
                meta: { breadCrumb: "Admin" },
            },
            {
                name: "admin.EmployeeRoleAdd",
                path: "EmployeeRoleAdd",
                component: () => import("../views/admin/employee/Create.vue"),
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
