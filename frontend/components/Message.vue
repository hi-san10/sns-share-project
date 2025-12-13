<script setup>
const config = useRuntimeConfig();
const props = defineProps(['post'])
const route = useRoute();
</script>
<template>
    <main>
        <div class="container-item">
            <p class="message-container__user_name">{{ post.user?.name }}</p>
            <img class="message-container__img" src="/heart.png" alt="" />
            <span class="message-container__count">0</span>
            <img class="message-container__img" src="/cross.png" alt="" />
            <NuxtLink :to="`/posts/${post.id}`">
                <img v-if="!route.params.id" class="message-container__img detail" src="/detail.png" alt="" />
            </NuxtLink>
        </div>
        <p class="message-container__comment">{{ post.content }}</p>
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
    width: 15%;
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
