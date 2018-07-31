<form action="" method="post" id="sign-in-form">
    <div class="text-center">
        <img src="/img/sign_in.png" alt="Sign in">
    </div>
    <h1 class="h2 mb-3 font-weight-normal text-center">Please sign in</h1>
    <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
<script src="/js/form.js"></script>