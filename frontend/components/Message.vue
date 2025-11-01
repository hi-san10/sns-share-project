<template>
    <main>
        <div class="message-container">
            <p class="message-container__user_name">userName</p>
            <img class="message-container__img" src="/heart.png" alt="">
            <span class="message-container__count">0</span>
            <img class="message-container__img" src="/cross.png" alt="">
            <img class="message-container__img detail" src="/detail.png" alt="">
        </div>
        <p class="message-container__comment">comment</p>
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
}
</style>