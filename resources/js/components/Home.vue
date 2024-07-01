<template>
    <div>
        <ul>
            <li>
                <router-link to="/users">Список пользователей</router-link>
            </li>
            <li>
                <router-link to="/admin">Администратор</router-link>
            </li>
        </ul>
        <router-view/>
    </div>
</template>

<script>

export default {
    name: "Home",
}
</script>

<style scoped>

</style>
