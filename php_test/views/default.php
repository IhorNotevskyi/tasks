<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Lang::getLang('lng.site_name') ?></title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/starter-template.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="collapse navbar-collapse<?php if (!Session::get('email')) : ?> not-logged-in<?php endif; ?>" id="navbarsExampleDefault">
            <?php if (Session::get('email')) : ?>
                <ul class="navbar-nav mr-auto">
                    <form action="/users/lang" method="post" class="form-inline">
                        <select name="language" class="form-control form-control-sm">
                            <option selected disabled><?= Lang::getLang('lng.select_language') ?></option>
                            <option value="uk"><?= Lang::getLang('lng.ukrainian') ?></option>
                            <option value="en"><?= Lang::getLang('lng.english') ?></option>
                        </select>
                        <input type="submit" value="<?= Lang::getLang('lng.choose') ?>" class="btn btn-sm btn-basic">
                    </form>
                </ul>
                <div class="my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="text-white"><?= Session::get('email') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users/logout"><i class="fa fa-sign-out"></i> <?= Lang::getLang('lng.logout') ?></a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <main role="main" class="container">

        <div class="starter-template">
            <?php if (Session::hasFlash()) : ?>
                <div class="alert alert-info" role="alert">
                    <?php Session::flash(); ?>
                </div>
            <?php endif; ?>

            <?= $data['content'] ?>
        </div>

    </main><!-- /.container -->

</body>
</html>