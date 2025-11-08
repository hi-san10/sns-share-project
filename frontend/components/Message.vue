<script setup>
const config = useRuntimeConfig();
const { data: posts, error } = await useFetch(`${config.public.apiBase}/posts`);
</script>
<template>
    <main>
        <div v-for="post in posts" :key="post.id" class="message-container">
            <div class="container-item">
                <p class="message-container__user_name">{{ post.name }}</p>
                <img class="message-container__img" src="/heart.png" alt="" />
                <span class="message-container__count">0</span>
                <img class="message-container__img" src="/cross.png" alt="" />
                <img class="message-container__img detail" src="/detail.png" alt="" />
            </div>
            <p class="message-container__comment">{{ post.content }}</p>
        </div>
    </main>
</template>

<style scoped>
main {
    width: 100%;
    margin-top: 65px;
}

.message-container {
    display: flex;
    align-items: center;
    flex-direction: column;
    margin-bottom: 30px;
}

.container-item {
    display: flex;
}

.message-container__img {
    width: 40px;
    height: 40px;
    margin-right: 20px;
    }

.detail {
    margin-left: 60px;
}

.message-container__user_name {
    color: white;
    margin-right: 20px;
    font-size: x-large;
}

.message-container__count {
    color: white;
    margin-right: 20px;
    font-size: x-large;
}

.message-container__comment {
    color: white;
    margin-right: auto;
}
</style>
