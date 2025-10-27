<template>
    <AuthHeader />
    <main>
        <div class="register-container">
            <p class="register-container__title">新規登録</p>
            <form action="" class="register-container__form">
                <input type="text" placeholder="ユーザーネーム" class="register-container__input">
                <input type="email" placeholder="メールアドレス" class="register-container__input">
                <input type="password" placeholder="パスワード" class="register-container__input">
                <input type="submit" value="新規登録" class="register-container__submit">
            </form>
        </div>
    </main>
</template>

<style scoped>
main {
    background-color: #15202B;
    height: 90vh;
    display: flex;
}

.register-container {
    background-color: white;
    width: 400px;
    height: 250px;
    margin: auto;
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
</style>