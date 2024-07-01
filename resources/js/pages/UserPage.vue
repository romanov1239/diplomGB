<template>
    <div>
        <h1>User name: {{ user.name }}</h1>
        <h2>User email: {{ user.email }}</h2>
        <h2>User role: {{ user.role }}</h2>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Страница пользователя",
    data() {
        return {
            id: null,
            user: {},
        };
    },
    async mounted() {
        this.id = this.$route.params.id;
        let result = await axios.get(`/users/${this.id}`);
        this.user = result.data;
    },
}
</script>

<style scoped>
</style>
