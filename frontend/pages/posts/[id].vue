<script setup>
import { useRoute } from 'vue-router';
import { useRuntimeConfig } from '#app';

const config = useRuntimeConfig();
const route = useRoute();
const id = route.params.id;
const { data:post } = await useFetch(`${config.public.apiBase}/api/posts/${id}`)
</script>
<template>
    <main class="posts-container">
        <SideNav />
        <div>
            <h1 class="container-title">コメント</h1>
            <Message v-if="post" :post="post"/>
        </div>
    </main>
</template>

<style scoped>
.posts-container {
    display: flex;
    background-color: #15202B;
}

.container-title {
    color: white;
    margin: 50px 0 0 0 ;
}

h1 {
    color: white;
}
</style>