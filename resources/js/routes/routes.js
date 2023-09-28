const MainLayout = ()  => import('../layouts/Main.vue');

export default [
    {
        path: '/',
        component: MainLayout,
        children: [
            {
                path: '/',
                name: 'home',
                component: () => import('../views/home/index.vue'),
            },
            {
                path: '/projects',
                name: 'projects',
                component: () => import('../views/projects/index.vue'),
            },
            {
                path: '/projects/create',
                name: 'project.create',
                component: () => import('../views/projects/create.vue'),
            },
            {
                path: '/issues',
                name: 'issues',
                component: () => import('../views/issues/index.vue'),
            },
            {
                path: '/issues/create',
                name: 'issue.create',
                component: () => import('../views/issues/create.vue'),
            },
        ]
    },
    {
        path: "/:pathMatch(.*)*",
        name: 'NotFound',
        component: () => import("../views/errors/404.vue"),
    },
];
