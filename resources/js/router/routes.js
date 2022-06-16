const Settings = () => import("../views/Settings.vue");
const Profile = () => import("../views/Profile.vue");
const Home = () => import("../views/Home.vue");
const Welcome = () => import("../views/Welcome.vue");
const Test = () => import("../views/Test.vue");
const Password = () => import("../views/auth/Password.vue");
const Login = () => import("../views/auth/Login.vue");
const ForgotPassword = () => import("../views/auth/ForgotPassword.vue");
const ResetPassword = () => import("../views/auth/ResetPassword.vue");
const VerifyEmail = () => import("../views/auth/VerifyEmail.vue");
const Register = () => import("../views/auth/Register.vue");
const CompanyIndex = () => import("../views/company/Index.vue");
const CompanyCreate = () => import("../views/company/Create.vue");
const CompanyEdit = () => import("../views/company/Edit.vue");
const ToursIndex = () => import("../views/tours/Index.vue");
const ToursCreate = () => import("../views/tours/Create.vue");
const ToursEdit = () => import("../views/tours/Edit.vue");

export default [
    {
        path: "/",
        component: Welcome,
        name: "welcome",
    },
    {
        path: "/home",
        component: Home,
        name: "home",
        meta: {
            guard: "auth",
        },
    },
    {
        path: "/login",
        component: Login,
        name: "login",
        meta: {
            guard: "guest",
        },
    },
    {
        path: "/forgot-password",
        component: ForgotPassword,
        name: "forgot-password",
        meta: {
            guard: "guest",
        },
    },
    {
        path: "/reset-password/:token",
        props: (route) => ({
            token: route.params.token,
            email: route.query.email,
        }),
        component: ResetPassword,
        name: "reset-password",
        meta: {
            guard: "guest",
        },
    },
    {
        path: "/register",
        component: Register,
        name: "register",
        meta: {
            guard: "guest",
        },
    },
    {
        path: "/test",
        component: Test,
        name: "test",
        meta: {
            guard: "auth",
        },
    },
    {
        path: "/verify-email/:id/:hash",
        props: (route) => ({
            id: route.params.id,
            hash: route.params.hash,
        }),
        component: VerifyEmail,
        name: "verify-email",
    },
    {
        path: "/settings",
        component: Settings,
        redirect: {
            name: "profile",
        },
        name: "settings",
        meta: {
            guard: "auth",
        },
        children: [
            {
                path: "profile",
                component: Profile,
                name: "profile",
                meta: {
                    guard: "auth",
                },
            },
            {
                path: "password",
                component: Password,
                name: "password",
                meta: {
                    guard: "auth",
                },
            },
        ],
    },
    {
        path: "/:pathMatch(.*)*",
        redirect: "/home",
    },
    {
        path: "/company",
        component: CompanyIndex,
        name: "company",
    },
    {
        path: "/company/create",
        component: CompanyCreate,
        name: "company.create",
    },
    {
        path: "/company/:id/edit",
        component: CompanyEdit,
        name: "company.edit",
        props: true,
    },
    {
        path: "/tours",
        component: ToursIndex,
        name: "tours",
    },
    {
        path: "/tours/create",
        component: ToursCreate,
        name: "tours.create",
    },
    {
        path: "/tours/:id/edit",
        component: ToursEdit,
        name: "tours.edit",
        props: true,
    },
];
