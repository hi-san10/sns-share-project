<script setup>
import { useRoute } from 'vue-router';
import { useRuntimeConfig } from '#app';
import { ref } from 'vue';

const config = useRuntimeConfig();
const route = useRoute();
const id = route.params.id;
const { data: post } = await useFetch(`${config.public.apiBase}/api/posts/${id}`)

const nuxtApp = useNuxtApp();
const auth = nuxtApp.$auth;
const currentUserUid = auth.currentUser.uid;
const postUserUid = post.value.user.firebase_uid;

const content = ref('');

// コメント送信
const comment = async () => {
    const idToken = await auth.currentUser.getIdToken()

    try {
        await $fetch(`${config.public.apiBase}/api/comment`, {
            method: 'POST',
            body: {
                postId: post.value.id,
                content: content.value,
            },
            headers: {
                Authorization: `Bearer ${idToken}`,
            }
        })
        content.value = ''
    } catch (error) {
        console.log(error)
    }
}
</script>
<template>
    <main class="posts-container">
        <SideNav />
        <div class="comment-container">
            <h1 class="container-title">コメント</h1>
            <Message v-if="post" :post="post"/>
            <p class="container-sub_title">コメント</p>
            <div class="comment_item" v-for="comment in post.comments">
                <p class="posts-container__comment comment_user">{{ comment.user.name }}</p>
                <p class="posts-container__comment">{{ comment.content }}</p>
            </div>
            <div v-if="currentUserUid !== postUserUid" class="comment-block">
                <form @submit.prevent="comment" class="comment__form" action="">
                    <textarea v-model="content" class="comment__textarea"></textarea>
                    <input type="submit" class="comment__submit" value="コメント">
                </form>
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

.comment-block {
    margin-top: 25px;
}

.comment__form {
    width: 90%;
}

.comment__textarea {
    width: 100%;
    background-color: #15202B;
    border: solid 1px white;
    border-radius: 10px;
    color: white;
}

.comment__submit {
    display: block;
    color: white;
    background-color: #5419DA;
    border-radius: 20px;
    display: block;
    margin: 10px 0 0 auto;

}
</style>