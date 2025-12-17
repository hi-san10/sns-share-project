<script setup>
const config = useRuntimeConfig();
const props = defineProps(['post'])
const route = useRoute();
const user = useState('user');
const userId = user.value.id;
const id = props.post.id;

// いいね
const nice = async () => {
    try {
        await $fetch(`${config.public.apiBase}/api/nice`, {
            method: 'POST',
            body: {
                userId: user.value.id,
                postId: props.post.id,
            }
        })
    } catch (error) {
        console.log(error)
    }
}

// 投稿削除
const postDelete = async () => {
    if (user.value.id !== props.post.user_id) return

    try {
        await $fetch(`${config.public.apiBase}/api/posts/${id}/${userId}`, {
            method: 'DELETE',
        })
    } catch (error) {
        console.log(error)
    }
}
</script>
<template>
    <main>
        <div class="container-item">
            <p class="message-container__user_name">{{ post.user?.name }}</p>
            <img @click.prevent.stop="nice" class="message-container__img" src="/heart.png" alt="" />
            <span class="message-container__count">{{ post.nices_count }}</span>
            <img  @click.prevent.stop="postDelete" class="message-container__img" src="/cross.png" alt="" />
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
