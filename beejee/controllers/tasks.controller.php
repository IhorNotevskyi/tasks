<?php

class TasksController extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->model = new Task();
    }

    public function index()
    {
        if (isset($_GET['page'])) {
            $page = (int)strip_tags($_GET['page'] - 1);
        }
        $page = !isset($page) ? 0 : $page;

        $this->data['tasks'] = $this->model->getBookListByPage($page);
    }

    public function add()
    {
        if ($_POST && $this->checkTasksFields() && $_POST['username'] && $_POST['email'] && $_POST['task']) {
            $username = strip_tags($_POST['username']);
            $email = strip_tags($_POST['email']);
            $task = strip_tags($_POST['task']);

            if ($this->checkUser()) {
                $isDone = ($_POST['is_done'] && $_POST['is_done'] === 'on') ? 1 : 0;
            } else {
                $isDone = 0;
            }

            $image = $_FILES['image']['name'] ? $this->generateImageName($_FILES['image']['type']) : '';

            $result = $this->model->addTask($username, $email, $task, $isDone, $image);

            $this->moveUploadedImage($_FILES, $image);

            $this->changeImageSize($image);
            $this->checkImageSize($image);

            if ($result) {
                Session::setFlash('Задача успешно добавлена');
            } else {
                Session::setFlash('Ошибка');
            }
        }
    }

    public function edit()
    {
        if ($this->checkUser()) {
            $paramsId = (int)strip_tags($this->params[0]);

            if ($_POST && $this->checkTasksFields() && $_POST['id'] && $_POST['username'] && $_POST['email'] && $_POST['task']) {
                $id = (int)strip_tags($_POST['id']);
                $username = strip_tags($_POST['username']);
                $email = strip_tags($_POST['email']);
                $task = strip_tags($_POST['task']);
                $isDone = ($_POST['is_done'] && $_POST['is_done'] === 'on') ? 1 : 0;

                $imageName = $this->model->getImageName($paramsId);
                $image = $_FILES['image']['name'] ? $this->generateImageName($_FILES['image']['type']) : $imageName[0]['image'];
                $result = $this->model->saveTask($id, $username, $email, $task, $isDone, $image);

                $this->moveUploadedImage($_FILES, $image);

                $this->changeImageSize($image);
                $this->checkImageSize($image);

                if ($_FILES['image']['name']) {
                    unlink(ROOT . DS . IMAGE_PATH . DS . $imageName[0]['image']);
                }

                if ($result) {
                    Session::setFlash('Задача успешно отредактирована');
                } else {
                    Session::setFlash('Ошибка');
                }
            }

            if (isset($paramsId)) {
                $this->data = $this->model->getTaskById($paramsId)[0];
            } else {
                Session::setFlash('Неверный ID страницы');
            }
        } else {
            throw new Exception('Page not found');
        }
    }

    public function delete()
    {
        if (isset($this->params[0])) {
            $paramsId = (int)strip_tags($this->params[0]);
            $image = $this->model->getImageName($paramsId);
            $this->model->deleteTask($paramsId);

            if ($image) {
                unlink(ROOT . DS . IMAGE_PATH . DS . $image[0]['image']);
            }

            Router::redirect('/tasks');
        }
    }

    public function generateImageName($imageMimeType)
    {
        $ext = '';
        if ($imageMimeType == 'image/jpeg') $ext = '.jpg';
        if ($imageMimeType == 'image/png') $ext = '.png';
        if ($imageMimeType == 'image/gif') $ext = '.gif';

        $name = md5(microtime()) . '_' . uniqid() . $ext;

        return $name;
    }

    public function moveUploadedImage($file, $name)
    {
        $uploadsDir = ROOT . DS . IMAGE_PATH;
        move_uploaded_file($file['image']['tmp_name'], $uploadsDir . DS . $name);
    }

    public function checkTasksFields()
    {
        if ($_POST['username'] === '') {
            Session::setFlash('Поле "Имя пользователя" является обязательным и должно быть заполнено');
            return false;
        }
        if (mb_strlen($_POST['username']) > 100) {
            Session::setFlash('В поле "Имя пользователя" можно ввести максимум 100 символов');
            return false;
        }
        if ($_POST['email'] === '') {
            Session::setFlash('Поле "E-mail" является обязательным и должно быть заполнено');
            return false;
        }
        if (!preg_match('/^(?:[a-z0-9!#$%&\'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/', $_POST['email'])) {
            Session::setFlash('Вы ввели некорректный e-mail');
            return false;
        }
        if ($_POST['task'] === '') {
            Session::setFlash('Поле "Задача" является обязательным и должно быть заполнено');
            return false;
        }
        if ($_FILES['image']['size'] > 3 * pow(10,6)) {
            Session::setFlash('Превышен максимальный размер файла');
            return false;
        }
        if ($_FILES['image']['type'] && !in_array($_FILES['image']['type'], ALLOW_TYPES)) {
            Session::setFlash('Недопустимый формат файла');
            return false;
        }

        return true;
    }

    public function changeImageSize($image, $imageWidth = '320', $imageHeight = '240')
    {
        $imagePath = ROOT . DS . IMAGE_PATH . DS;

        if ($_FILES['image']['type'] == 'image/jpeg') {
            $imageCreate = imagecreatefromjpeg($imagePath . $image);
        } elseif ($_FILES['image']['type'] == 'image/png') {
            $imageCreate = imagecreatefrompng($imagePath . $image);
        } elseif ($_FILES['image']['type'] == 'image/gif') {
            $imageCreate = imagecreatefromgif($imagePath . $image);
        }

        $imagesx = imagesx($imageCreate);
        $imagesy = imagesy($imageCreate);

        $imageCreateTrueColor = imagecreatetruecolor($imageWidth, $imageHeight);
        imagecopyresampled($imageCreateTrueColor, $imageCreate, 0, 0, 0, 0, $imageWidth, $imageHeight, $imagesx, $imagesy);

        if ($_FILES['image']['type'] == 'image/jpeg') {
            imagejpeg($imageCreateTrueColor, $imagePath . $image);
        } elseif ($_FILES['image']['type'] == 'image/png') {
            imagepng($imageCreateTrueColor, $imagePath . $image);
        } elseif ($_FILES['image']['type'] == 'image/gif') {
            imagegif($imageCreateTrueColor, $imagePath . $image);
        }
    }

    public function checkImageSize($image, $imageWidth = '320', $imageHeight = '240')
    {
        list($width, $height) = getimagesize(ROOT . DS . IMAGE_PATH . DS . $image);

        if ($width != $imageWidth || $height != $imageHeight) {
            Session::setFlash('Не удалось уменьшить размер файла');
            return false;
        }
    }

    public function checkUser()
    {
        if ($this->user && $this->user->getLogin() && $this->user->getRole() === 'admin') {
            return true;
        }

        return false;
    }
}