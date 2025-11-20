<script setup>
import { ref } from 'vue'
import { createUserWithEmailAndPassword } from "firebase/auth"

const config = useRuntimeConfig();
const router = useRouter();

const name = ref('');
const email = ref('');
const password = ref('');

let auth = null
const nuxtApp = useNuxtApp()
auth = nuxtApp.$auth

const register = async () => {
    try {
    // Firebase で登録
        const userCredential = await createUserWithEmailAndPassword(auth, email.value, password.value)
        const user = userCredential.user

    // IDトークン取得
        const idToken = await user.getIdToken(true)

    // Laravel API へ送信
        const data = await $fetch(`${config.public.apiBase}/api/register`, {
            method: 'POST',
            body: {
                name: name.value,
                email: email.value,
                password: password.value,
            },
            headers: {
                Authorization: `Bearer ${idToken}`
            }
        })
        if (data.user) {
            await console.log(data.user)
            await router.push('/login')
        }
        console.log('登録完了')
    } catch (err) {
        console.error('Firebase Error:', err)
        console.log('Error code:', err.code)
        console.log('Error message:', err.message)
    }
}
</script>


<template>
    <AuthHeader />
    <main>
        <div class="register-container">
            <p class="register-container__title">新規登録</p>
            <form @submit.prevent="register" class="register-container__form">
                <input type="text" v-model="name" placeholder="ユーザーネーム" class="register-container__input">
                <input type="email" v-model="email" placeholder="メールアドレス" class="register-container__input">
                <input type="password" v-model="password" placeholder="パスワード" class="register-container__input">
                <input type="submit" value="新規登録" class="register-container__submit">
            </form>
        </div>
        <!-- <p class="error_message" v-if="error">{{ error }}</p> -->
    </main>
</template>

<style scoped>
main {
    background-color: #15202B;
    height: 90vh;
    display: flex;
    flex-direction: column;
}

.register-container {
    background-color: white;
    width: 400px;
    height: 250px;
    margin: 250px auto 100px auto;
    border-radius: 5px;
}

.register-container__title {
    text-align: center;
    font-weight: bold;
    margin: 15px auto;
}

.register-container__form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
}

.register-container__input {
    width: 280px;
    padding: 5px;
    margin-bottom: 10px;
    border: 0.5px solid black;
    border-radius: 5px;
}

.register-container__submit {
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