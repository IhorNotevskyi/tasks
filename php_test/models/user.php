<?php

class User extends Model
{
    public function getUserByEmail($email)
    {
        $email = $this->db->escape($email);
        $sql = "SELECT * FROM users 
                    WHERE email = '{$email}'";
        $result = $this->db->query($sql);

        if (isset($result[0])) {
            return $result[0];
        }

        return false;
    }
}