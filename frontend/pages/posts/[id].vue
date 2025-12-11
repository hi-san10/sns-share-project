<script setup>
import { useRoute } from 'vue-router';
import { useRuntimeConfig } from '#app';

const config = useRuntimeConfig();
const route = useRoute();
const id = route.params.id;
console.log(route.params.id)
const { data: post } = await useFetch(`${config.public.apiBase}/api/posts/${id}`)
</script>
<template>
    <main class="posts-container">
        <SideNav />
        <div class="comment-container">
            <h1 class="container-title">コメント</h1>
            <Message v-if="post" :post="post"/>
            <p class="container-sub_title">コメント</p>
            <div class="comment_item" v-for="comment in post.comments">
                <p class="posts-container__comment comment_user">{{ post.user.name }}</p>
                <p class="posts-container__comment">{{ comment.content }}</p>
            </div>
        </div>
    </main>
</template>

<style scoped>
.posts-container {
    display: flex;
    background-color: #15202B;
}

.comment-container {
    width: 70%;
}

.container-title {
    color: white;
    margin: 50px 0 0 0 ;
}

.container-sub_title {
    color: white;
    text-align: center;
    margin: 20px auto 5px auto;
}

.comment_item {
    border: white 1px solid;
    width: 95%;
}

.posts-container__comment {
    color: white;
    margin: auto auto auto 20px;
}

.comment_user {
    font-size: x-large;
}
</style>