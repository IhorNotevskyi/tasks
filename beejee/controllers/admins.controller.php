<?php

class AdminsController extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->model = new Admin();
    }

    public function login()
    {
        if ($_POST && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
            $login = strip_tags($_POST['login']);
            $user = $this->model->getAdminByLogin($login);
            $hash = md5(Config::get('salt') . $_POST['password']);

            if ($user && $user['login'] == $login && $hash == $user['password']) {
                Session::set('login', $user['login']);

                $userData = new User();
                $userData->setLogin($user['login']);
                $userData->setRole($user['role']);
                Session::set('user', serialize($userData));

                Router::redirect('/');
            } else {
                $userData = new User();
                $userData->setLogin('guest');
                $userData->setRole('guest');
                Session::set('user', serialize($userData));

                Session::setFlash('Вход в админ-панель не выполнен. Пожалуйста, попробуйте еще раз.');
            }
        }
    }

    public function logout()
    {
        Session::destroy();
        Router::redirect('/');
    }
}