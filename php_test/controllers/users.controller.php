<?php

class UsersController extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->model = new User();
    }

    public function lang()
    {
        if ($_POST && isset($_POST['language']) && in_array($_POST['language'], Config::get('languages'))) {
            setcookie('language', $_POST['language'], time() + 60 * 60 * 24 * 365);
            $url = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
            $urlParts = explode('/', mb_substr($url, 1));

            if (in_array(array_shift($urlParts), Config::get('languages'))) {
                $url = mb_substr($url, 3);
            }

            if ($_POST['language'] === 'en') {
                Lang::load($_POST['language']);
                Router::redirect('/en' . $url);
            } elseif ($_POST['language'] === 'uk') {
                Lang::load($_POST['language']);
                Router::redirect('/uk' . $url);
            }
        }
    }

    public function login()
    {
        $pattern = '/^(?:[a-z0-9!#$%&\'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/';

        if ($_POST && isset($_POST['email']) && preg_match($pattern, $_POST['email']) && isset($_POST['password']) && isset($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
            $email = strip_tags($_POST['email']);
            $user = $this->model->getUserByEmail($email);
            $hash = md5(Config::get('salt') . $_POST['password']);

            if ($user && $user['email'] == $email && $hash == $user['password']) {
                Session::set('email', $user['email']);
            } else {
                Session::setFlash('Попробуйте еще раз');
            }

            if ($_COOKIE['language']) {
                Router::redirect('/' . $_COOKIE['language'] . '/books');
            } else {
                Router::redirect('/books');
            }
        }
    }

    public function logout()
    {
        Session::destroy();
        Router::redirect('/users/login');
    }
}