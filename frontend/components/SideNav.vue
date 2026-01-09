<script setup>
import { useField } from 'vee-validate';
import * as yup from 'yup';

const router = useRouter();
const nuxtApp = useNuxtApp();
const auth = nuxtApp.$auth;

// ログアウト
const logout = async () => {
    try {
        await auth.signOut()
        localStorage.removeItem('user')
        router.push('/login')
    } catch (err) {
        console.error(err)
    }
}

const config = useRuntimeConfig();
const emit = defineEmits(['newPost']);

// バリデーション
const { value: content, errors, validate, resetField } = useField(
    'content',
    yup
        .string()
        .required('投稿内容が空です')
        .max(120, '投稿は120文字以内で入力してください'),
    { validateOnInput: false, validateOnMount: false })

// 新規投稿
const post = async () => {
    const result = await validate()
    console.log("errors:", errors.value[0])
    if (!result.valid) return

    try {
        const user = auth.currentUser
        if (!user) return

        const idToken = await user.getIdToken()
        const newPost = await $fetch(`${config.public.apiBase}/api/posts`, {
            method: 'POST',
            body: {
                content: content.value,
            },
            headers: {
                Authorization: `Bearer ${idToken}`,
            }
        })
        emit('newPost', newPost)
        resetField();
    } catch (error) {
        console.log(error)
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
            <button @click="logout" class="item__link logout">ログアウト</button>
        </div>
        <form  @submit.prevent="post" class="side_nav-form">
            <p class="side_nav-title">シェア</p>
            <textarea v-model="content" class="side_nav-content"></textarea>
            <p v-if="errors[0]" class="validate_name" style="color: red; text-align: center;">{{ errors[0] }}</p>
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

.logout {
    background-color: #15202B;
    border: none;
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