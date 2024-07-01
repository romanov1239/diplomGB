<template>
    <div>
        <h2 :class="getClass(user.role)">{{ user.name }}</h2>
        <p>{{ text }}</p>
        <template v-if="user.role === 'client'">
            <small>{{ user.role }}</small>
        </template>
        <template v-else>
            <p>ID: {{ user.id }}</p>
            <p>{{ user.role }}</p>
            <p>{{ user.email }}</p>


        </template>
        <router-link :to="'/users/' + user.id">User's page</router-link>
    </div>
</template>

<script>
export default {
    props: ['user', 'text'],
    name: "Пользователь",
    methods: {
        getClass(role) {
            return 'top-'+role;
        }
    }
}
</script>

<style scoped>
.top-admin {
    color: green;
}
.top-manager {
    color: blue;
}
.top-client {
    color: red;
}
</style>
