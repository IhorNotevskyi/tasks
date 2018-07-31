<?php

class Admin extends Model
{
    public function getAdminByLogin($login)
    {
        $login = $this->db->escape($login);

        $sql = "SELECT * FROM admins 
                    WHERE login = '{$login}'";

        $result = $this->db->query($sql);

        if (isset($result[0])) {
            return $result[0];
        }

        return false;
    }
}