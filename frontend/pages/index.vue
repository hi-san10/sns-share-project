<script setup>
import { onMounted, ref } from 'vue';

const config = useRuntimeConfig();
const user = ref('');

onMounted(async () => {
    try {
        const res = await $fetch(`${config.public.apiBase}/api/user`, {
            credentials: 'include'
        })
        user.value = res
        const user_name = user.value.name;
        console.log('user', user_name)
    } catch (err) {
        console.log('noUser', err)
    }
})

const age = 36;
</script>

<template>
    <main class="home-container">
        <SideNav :user="user"/>
        <div>
            <h1 class="container-title">ホーム</h1>
            <h2 style="color: red;">{{ user.name }}</h2>
            <Message />
        </div>
    </main>
</template>

<style scoped>
.home-container {
    display: flex;
    background-color: #15202B;
}

.container-title {
    color: white;
    margin: 50px 0 0 0 ;
}
</style>