<script setup>
import { ref } from 'vue'
import { createUserWithEmailAndPassword } from "firebase/auth"
import { useForm, useField } from 'vee-validate';
import * as yup from 'yup';

const config = useRuntimeConfig();
const router = useRouter();

const email = ref('');
const password = ref('');
const error = ref('');

const nuxtApp = useNuxtApp()
const auth = nuxtApp.$auth

const schema = yup.object({
    name: yup
        .string()
        .required('お名前を入力してください')
        .max(20, 'お名前は20文字以内で入力してください')
})
const { handleSubmit, errors } = useForm({
    validationSchema: schema
})
const { value: name } = useField('name', { validateOnInput: false });

const register = handleSubmit(async (values) => {
    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email.value, password.value)
        const idToken = await userCredential.user.getIdToken(true)

        const data = await $fetch(`${config.public.apiBase}/api/register`, {
            method: 'POST',
            body: {
                name: values.name,
                email: email.value,
                password: password.value,
            },
            headers: {
                Authorization: `Bearer ${idToken}`
            }
        })
        if (data.user) {
            await router.push('/login')
        }

    } catch (err) {
        console.log(err)
        error.value = "登録失敗"
    }
})
</script>


<template>
    <AuthHeader />
    <main>
        <div class="register-container">
            <p class="register-container__title">新規登録</p>
            <form @submit.prevent="register" class="register-container__form">
                <input type="text" v-model="name" placeholder="ユーザーネーム" class="register-container__input">
                <p class="validate_name" style="color: red;">{{ errors.name }}</p>
                <input type="email" v-model="email" placeholder="メールアドレス" class="register-container__input">
                <input type="password" v-model="password" placeholder="パスワード" class="register-container__input">
                <input type="submit" value="新規登録" class="register-container__submit">
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

.register-container {
    background-color: white;
    width: 400px;
    /* height: 250px; */
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
    margin-bottom: 10px;
}

.error_message {
    color: red;
    text-align: center;
    font-size: x-large;
}
</style>