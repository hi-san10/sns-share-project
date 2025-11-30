<script setup>
import { onMounted, ref } from 'vue';

const config = useRuntimeConfig();
const user = JSON.parse(localStorage.getItem('user'));

const posts = ref([]);
const addPost = (newPost) => {
    posts.value.unshift(newPost)

}
onMounted(async () => {
    try {
        const data = await $fetch(`${config.public.apiBase}/api/posts`)
        posts.value = data;
    } catch (err) {
        console.log(err)
    }
})
</script>

<template>
    <main class="home-container">
        <SideNav  @newPost="addPost"/>
        <div>
            <h1 class="container-title">ホーム</h1>
            <h2 style="color: red;">{{ user.name }}</h2>
            <Message v-for="post in posts ?? []" :key="post.id" :post="post"/>
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