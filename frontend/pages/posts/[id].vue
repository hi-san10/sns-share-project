<template>
    <main class="posts-container">
        <SideNav />
        <div>
            <h1 class="container-title">コメント</h1>
            <Message />
            <h1>{{ $route.params.id }}</h1> <!-- id仮表示 -->
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