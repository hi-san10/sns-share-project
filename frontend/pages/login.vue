<template>
    <AuthHeader />
    <main>
        <div class="login-container">
            <p class="login-container__title">ログイン</p>
            <form action="" class="login-container__form">
                <input type="email" placeholder="メールアドレス" class="login-container__input">
                <input type="password" placeholder="パスワード" class="login-container__input">
                <input type="submit" value="ログイン" class="login-container__submit">
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

.login-container {
    background-color: white;
    width: 400px;
    height: 250px;
    margin: auto;
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
</style>