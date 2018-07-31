<form action="" method="post" id="sign-in-form">
    <div class="text-center">
        <img src="/img/sign_in.png" alt="Sign in">
    </div>
    <h1 class="h2 mb-3 font-weight-normal text-center">Вход в админ-панель</h1>
    <input type="text" name="login" class="form-control" placeholder="Логин" required autofocus>
    <input type="password" name="password" class="form-control" placeholder="Пароль" required>
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
</form>
<script src="/js/form.js"></script>