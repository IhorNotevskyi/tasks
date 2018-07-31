<?php

class User
{
    public $login;

    public $role;

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function isAllowed($privilege)
    {
        if ($privilege == 'admin_privileges') {
            return $this->login && $this->role == 'admin';
        }

        return false;
    }
}