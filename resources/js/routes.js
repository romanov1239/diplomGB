import { createRouter, createWebHistory } from 'vue-router';
import UsersList from './pages/UsersList.vue';
import UserPage from './pages/UserPage.vue';
import AdminPage from './pages/AdminPage.vue';

const routes = [
    { path: '/users', component: UsersList },
    { path: '/users/:id', component: UserPage },
    {
        path: '/admin',
        component: AdminPage,
        beforeEnter: (to, from, next) => {
            const password = prompt('Введите пароль для доступа к странице администратора:');

            if (password === 'ваш_пароль') {
                next();
            } else {
                next('/');
            }
        }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
