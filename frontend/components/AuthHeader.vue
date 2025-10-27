<template>
    <div class="header-container">
        <img class="header_logo" src="/logo.png" alt="">
        <div class="header__nav">
            <NuxtLink class="header__nav-link" to="/register">新規登録</NuxtLink>
            <NuxtLink class="header__nav-link" to="/login">ログイン</NuxtLink>
        </div>
    </div>
</template>

<style scoped>
.header-container {
    background-color: #15202B;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 10vh;
}


.header_logo {
    width: 300px;
    height: 70px;

}

.header__nav {
    margin: auto 0;
}

.header__nav-link {
    text-decoration: none;
    color: white;
    margin-right: 70px;
    font-size: large;
}
</style>