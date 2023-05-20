
export const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('@/pages/d.vue'),
        meta: {
            requiresAuth: true
        }
    },


    // System
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFoundPage',
        component: () => import('@/pages/system/Page404.vue'),
        meta: {
            requiresAuth: false,
            layout: 'system',
        },
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('@/pages/system/Login.vue'),
        meta: {
            requiresAuth: false,
            layout: 'system',
        }
    },
    {
        path: '/registration',
        name: 'Registration',
        component: () => import('@/pages/system/Registration.vue'),
        meta: {
            requiresAuth: false,
            layout: 'system',
        }
    },
];
