



<template>
    <div>
        <h2>{{ title }}</h2>

        <br>
        <h2>Создать пользователя</h2>

        <form @submit.prevent="createUser">
            <label htmlFor="name">Имя:</label>
            <input type="text" id="name" v-model="newUser.name" required>
            <label htmlFor="login">Email:</label>
            <input type="text" id="login" v-model="newUser.login" required>
            <label htmlFor="password">Пароль:</label>
            <input type="password" id="password" v-model="newUser.password" required>
            <label htmlFor="role_id">ID Роли:</label>
            <input type="number" id="roleid" v-model="newUser.roleid" required>
            <button type="submit">Создать пользователя</button>
        </form>

        <div v-if="message" class="message">
            {{ message }}
        </div>

        <br>
        <h2>Редактировать пользователя</h2>

        <form @submit.prevent="updateUser">
            <label htmlFor="edit-id">ID:</label>
            <input type="number" id="edit-id" v-model="editUser.id" required>
            <br>
            <label htmlFor="edit-name">Имя:</label>
            <input type="text" id="edit-name" v-model="editUser.name" required>
            <label htmlFor="edit-login">Email:</label>
            <input type="text" id="edit-login" v-model="editUser.login" required>
            <label htmlFor="edit-password">Пароль:</label>
            <input type="password" id="edit-password" v-model="editUser.password" required>
            <label htmlFor="edit-role_id">ID Роли:</label>
            <input type="number" id="edit-roleid" v-model="editUser.roleid" required>
            <button type="submit">Обновить пользователя</button>
        </form>

        <div v-if="editMessage" class="message">
            {{ editMessage }}
        </div>

        <br>
        <h2>Удалить пользователя</h2>

        <form @submit.prevent="deleteUser">
            <label htmlFor="delete-id">ID пользователя:</label>
            <input type="number" id="delete-id" v-model="deleteUserId" required>
            <button type="submit">Удалить пользователя</button>
        </form>

        <div v-if="deleteMessage" class="message">
            {{ deleteMessage }}
        </div>
    </div>
</template>

<script>
import {ref, onMounted} from 'vue';
import axios from 'axios';

export default {
    name: "UserList",
    setup() {
        const title = 'Страница администратора';
        const users = ref();
        const newUser = ref({name: '', login: '', password: '', role_id: ''});
        const editUser = ref({id: '', name: '', login: '', password: '', role_id: ''});
        const message = ref('');
        const editMessage = ref('');
        const deleteUserId = ref('');
        const deleteMessage = ref('');

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
                    roleid: newUser.value.roleid
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
        const updateUser = async () => {
            try {
                await axios.put(`/api/custom_users/${editUser.value.id}`, {
                    name: editUser.value.name,
                    login: editUser.value.login,
                    password: editUser.value.password,
                    role_id: editUser.value.role_id
                });
                editMessage.value = 'Пользователь успешно обновлен.';
                await loadUsers();
                editUser.value = {id: '', name: '', login: '', password: '', role_id: ''};
            } catch (error) {
                console.error('Ошибка обновления пользователя:', error.response);
                if (error.response && error.response.data) {
                    editMessage.value = error.response.data.message;
                } else {
                    editMessage.value = 'Ошибка при обновлении пользователя.';
                }
            }
        };

        const deleteUser = async () => {
            try {
                await axios.delete(`/api/custom_users/${deleteUserId.value}`);
                deleteMessage.value = 'Пользователь успешно удален.';
                await loadUsers();
            } catch (error) {
                console.error('Ошибка удаления пользователя:', error.response);
                if (error.response && error.response.data) {
                    deleteMessage.value = error.response.data.message;
                } else {
                    deleteMessage.value = 'Ошибка при удалении пользователя.';
                }
            }
        };

        return {
            title,
            users,
            newUser,
            editUser,
            message,
            editMessage,
            deleteUserId,
            deleteMessage,
            createUser,
            updateUser,
            deleteUser
        };
    }
}
</script>

<style scoped>
.message {
    margin-top: 10px;
    padding: 10px;
    background-color: #e2f0d9;
    border: 1px solid #b6d7a8;
    border-radius: 4px;
}
</style>

