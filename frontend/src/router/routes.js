
export const routes = [
    // DEFAULT
    {
        path: '/',
        name: 'home',
        component: () => import('@/pages/Home.vue'),
        meta: {
            requiresAuth: false
        }
    },

    // MAIN
    {
        path: '/cabinet',
        name: 'Cabinet',
        component: () => import('@/pages/cabinet/Cabinet.vue'),
        meta: {
            requiresAuth: true,
            layout: 'main',
        }
    },
    {
        path: '/cabinet/setting',
        name: 'Setting',
        component: () => import('@/pages/cabinet/Setting.vue'),
        meta: {
            requiresAuth: true,
            layout: 'main',
        }
    },


    // SYSTEM
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
