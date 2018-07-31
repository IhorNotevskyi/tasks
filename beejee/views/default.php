<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Config::get('site_name') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/starter-template.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <link href="/css/sweetalert2/sweetalert2.css" rel="stylesheet">
    <script src="/js/sweetalert2/sweetalert2.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" style="padding-bottom: 20px">
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="/" class="h1 text-white font-weight-bold"><?= Config::get('site_name') ?></a>
                    </li>
                </ul>
                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto" style="padding-top: 5px">
                        <?php if ($user) : ?>
                            <li class="nav-item">
                                <a class="text-white">Добро пожаловать, <span class="font-weight-bold"><?= $user->getLogin() ?></span></a>
                            </li>
                            <li class="nav-item">
                                <a href="/admins/logout" class="nav-link"><i class="fa fa-sign-out"></i>&ensp;Выйти</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="/admins/login" class="nav-link"><i class="fa fa-sign-in"></i>&ensp;Войти в админ-панель</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
        </div>
    </nav>
    <main>
        <div class="starter-template">
            <?php if (Session::hasFlash()) : ?>
                <div class="alert alert-info" role="alert" style="margin-bottom: 20px">
                    <?php Session::flash(); ?>
                </div>
            <?php endif; ?>

            <?= $data['content'] ?>
        </div>
    </main>
</body>
</html>