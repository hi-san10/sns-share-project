<script setup>
import { onMounted, ref } from 'vue';
import { onAuthStateChanged } from 'firebase/auth';
const nuxtApp = useNuxtApp()
const auth = nuxtApp.$auth

const router = useRouter();
const config = useRuntimeConfig();

const user = useState('user', () => ({}))
onMounted(() => {
    onAuthStateChanged(auth, (firebaseUser) => {
        if (!firebaseUser) {
            user.value = {};
            router.replace('/login')
        }
    })
    const stored = localStorage.getItem('user')
    user.value = stored ? JSON.parse(stored) : null
})

const posts = ref([]);
const addPost = (newPost) => {
    posts.value.unshift(newPost)

}
const fetchPosts = async () => {
    try {
        posts.value = await $fetch(`${config.public.apiBase}/api/posts`)
    } catch (err) {
        console.log(err)
    }
}
onMounted(fetchPosts);
</script>

<template>
    <main class="home-container">
        <SideNav  @newPost="addPost"/>
        <div class="container_item">
            <h1 class="container-title">ホーム</h1>
            <Message v-for="post in posts ?? []" :key="post.id" :post="post" @update="fetchPosts" @click="router.push(`/posts/${post.id}`)"/>
        </div>
    </main>
</template>

<style scoped>
.home-container {
    display: flex;
    background-color: #15202B;
}

.container_item {
    width: 70%;
}

.container-title {
    color: white;
    margin: 50px 0 0 0 ;
}
</style>