<script setup>
const { data: posts, error } = await useFetch('http://localhost:80/api/posts');
</script>

<template>
    <main class="home-container">
        <SideNav />
        <div>
            <h1 class="container-title">ホーム</h1>
            <Message />
             <div v-for="post in posts" :key="post.id">
                <p>{{ post.id }}</p>
                <p>{{ post.name }}</p>
             </div>
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