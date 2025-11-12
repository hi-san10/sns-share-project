<script setup>
import { ref } from 'vue';

const config = useRuntimeConfig();
const router = useRouter();

const email = ref('');
const password = ref('');
const error = ref('');

const login = async () => {
    try {
        await $fetch(`${config.public.apiBase}/sanctum/csrf-cookie`, {
            credentials: 'include',
        })

        const xsrfToken = useCookie('XSRF-TOKEN')
        const data = await $fetch(`${config.public.apiBase}/login`, {
            method: 'post',
            body: {
                email: email.value,
                password: password.value
            },
            credentials: 'include',
            headers: { 'X-XSRF-TOKEN': decodeURIComponent(xsrfToken.value) }
        })

        if (data.success) {
            await router.push('/')
        }
    } catch (err) {
        error.value = 'ログイン失敗'
    }
}
</script>

<template>
    <AuthHeader />
    <main>
        <div class="login-container">
            <p class="login-container__title">ログイン</p>
            <form @submit.prevent="login" class="login-container__form">
                <input type="email" v-model="email" placeholder="メールアドレス" class="login-container__input">
                <input type="password" v-model="password" placeholder="パスワード" class="login-container__input">
                <input type="submit" value="ログイン" class="login-container__submit">
            </form>
        </div>
        <p class="error_message" v-if="error">{{ error }}</p>
    </main>
</template>

<style scoped>
main {
    background-color: #15202B;
    height: 90vh;
    display: flex;
    flex-direction: column;
}

.login-container {
    background-color: white;
    width: 400px;
    height: 250px;
    margin: 250px auto 100px auto;
    border-radius: 5px;
}

.login-container__title {
    text-align: center;
    font-weight: bold;
    margin: 25px auto 35px auto;
}

.login-container__form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
}

.login-container__input {
    width: 280px;
    padding: 5px;
    margin-bottom: 20px;
    border: 0.5px solid black;
    border-radius: 5px;
}

.login-container__submit {
    background-color: #5419DA;
    color: white;
    border-radius: 20px;
    width: 100px;
    height: 40px;
    font-size: 12px;
}

.error_message {
    color: red;
    text-align: center;
    font-size: x-large;
}
</style>