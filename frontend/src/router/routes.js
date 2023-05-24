
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
        path: '/cabinet/profile',
        name: 'Profile',
        component: () => import('@/pages/cabinet/Profile.vue'),
        meta: {
            requiresAuth: true,
            layout: 'main',
        }
    },
    {
        path: '/cabinet/questionnaire',
        name: 'Questionnaire',
        component: () => import('@/pages/cabinet/Questionnaire.vue'),
        meta: {
            requiresAuth: true,
            layout: 'main',
        }
    },
    {
        path: '/cabinet/essay',
        name: 'Essay',
        component: () => import('@/pages/cabinet/Essay.vue'),
        meta: {
            requiresAuth: true,
            layout: 'main',
        }
    },
    {
        path: '/cabinet/internships',
        name: 'Internships',
        component: () => import('@/pages/cabinet/Internships.vue'),
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
