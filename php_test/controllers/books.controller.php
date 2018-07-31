<?php

class BooksController extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->model = new Book();
    }

    public function index()
    {
        if (Session::get('email') && $_COOKIE['language'] && in_array($_COOKIE['language'], Config::get('languages'))) {
            $name = 'name_' . $_COOKIE['language'];
        } else {
            $name = 'name_' . Config::get('default_language');
        }

        $this->data['books'] = $this->model->getBookList($name);
    }
}