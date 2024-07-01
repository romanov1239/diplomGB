<template>
    <div>
        <h2>{{ title }}</h2>

        <div v-if="message" className="message">
            {{ message }}
        </div>

        <div v-if="users.length === 0">Пользователи не найдены</div>
        <div v-else>
            <div v-for="(user, index) in users" :key="index">
                <user-card :user="user" />
                <hr />
            </div>
        </div>


    </div>
</template>

<script>
import {ref, onMounted} from 'vue';
import User from '../components/users/User.vue';
import axios from 'axios';

export default {
    name: "UserList",
    components: {
        'user-card': User,
    },
    setup() {
        const title = 'Список пользователей';
        const users = ref([]);
        const newUser = ref({id: '', name: '', login: '', password: '', role_id: ''});
        const message = ref('');

        onMounted(async () => {
            await loadUsers();
        });

        const loadUsers = async () => {
            try {
                let result = await axios.get('users');
                users.value = result.data;
            } catch (error) {
                console.error('Ошибка загрузки пользователей:', error);
            }
        };

        const createUser = async () => {
            try {
                let response = await axios.post('/api/custom_users', {
                    name: newUser.value.name,
                    login: newUser.value.login,
                    password: newUser.value.password,
                    role_id: newUser.value.role_id
                });

               message.value = 'Пользователь успешно создан.';
                await loadUsers();
                newUser.value = {name: '', login: '', password: '', role_id: ''};
            } catch (error) {
                console.error('Ошибка создания пользователя:', error.response);
                if (error.response && error.response.data) {
                    message.value = error.response.data.message;
                } else {
                    message.value = 'Ошибка при создании пользователя.';
                }
            }
        };

        return {
            title,
            users,
            newUser,
            createUser,
            message,
        };
    }
}
</script>

<style scoped>
message {
    margin-top: 10px;
    padding: 10px;
    background-color: #e2f0d9;
    border: 1px solid #b6d7a8;
    border-radius: 4px;
}
hr {
    text-align: center;
    width: 50%;
    margin: 10px auto;
    border: 0;
    border-top: 1px solid #ccc;
}
</style>
