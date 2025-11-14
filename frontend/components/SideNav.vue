<script setup>
const config = useRuntimeConfig();
const router = useRouter();
const logout = async () => {
    try {
        const xsrfToken = useCookie('XSRF-TOKEN')
        const data = await $fetch(`${config.public.apiBase}/logout`, {
            method: 'post',
            credentials: 'include',
            headers: { 'X-XSRF-TOKEN': decodeURIComponent(xsrfToken.value) }
        })

        if (data.logout) {
            router.push('/login')
        }
    } catch (err) {
        console.error(err)
    }
}
</script>

<template>
    <main>
        <img src="/logo.png" alt="" class="logo">
        <div class="side_nav-item">
            <img src="/home.png" alt="" class="item__img">
            <NuxtLink to="/" class="item__link">ホーム</NuxtLink>
        </div>
        <div class="side_nav-item">
            <img src="/logout.png" alt="" class="item__img">
            <button @click="logout" class="item__link">ログアウト</button>
        </div>
        <form action="" class="side_nav-form">
            <p class="side_nav-title">シェア</p>
            <textarea name="" id="" class="side_nav-content"></textarea>
            <input type="submit" class="side_nav-submit" value="シェアする">
        </form>
    </main>
</template>

<style scoped>
main {
    background-color: #15202B;
    width: 30%;
    height: 100vh;
}

.logo {
    width: 300px;
    height: 70px;
    margin: 50px 20px 0 50px;
}

.side_nav-item {
    display: flex;
    margin: 25px auto 0 50px;
    align-items: center;
}

.item__img {
    width: 50px;
    height: 50px;
}

.item__link {
    color: white;
    text-decoration: none;
    margin-left: 30px;
    font-weight: bold;
}

.side_nav-title {
    color: white;
    margin: 25px 0 0 50px;
    font-weight: bold;
}

.side_nav-content {
    background-color: #15202B;
    border-color: white;
    border-radius: 5px;
    margin: 10px auto;
    width: 80%;
    height: 250px;
    display: block;
    color: white;
}

.side_nav-submit {
    display: block;
    color: white;
    background-color: #5419DA;
    border-radius: 20px;
    display: block;
    margin: 20px 45px 0 auto;
}
</style>