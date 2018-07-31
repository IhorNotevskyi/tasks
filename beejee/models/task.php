<?php

class Task extends Model
{
    public function getBookListByPage($page = 0, $limit = 3)
    {
        $page = $this->db->escape($page);
        $start = $page * $limit;

        $sql = "SELECT * FROM tasks 
                    ORDER BY id DESC
                    LIMIT {$start}, {$limit}";

        $result = $this->db->query($sql);
        $result['count'] = $this->getCountPages($limit);

        return $result;
    }

    public function getCountPages($limit = 3)
    {
        $sql = "SELECT COUNT(*) AS count FROM tasks";

        $countTasks = $this->db->query($sql);
        $totalRows = ($countTasks[0]['count']);
        $numPages = ceil($totalRows / $limit);

        if ($_GET['page'] > $numPages) {
            throw new Exception('Page not found');
        }

        return $numPages;
    }

    public function getTaskById($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT * FROM tasks
                    WHERE id = '{$id}'";

        return $this->db->query($sql);
    }

    public function addTask($username, $email, $task, $isDone, $image)
    {
        $username = $this->db->escape($username);
        $email = $this->db->escape($email);
        $task = $this->db->escape($task);

        $sql = "INSERT INTO tasks
                    SET username = '{$username}',
                        email = '{$email}',
                        task = '{$task}',
                        is_done = '{$isDone}',
                        image = '{$image}'";

        return $this->db->query($sql);
    }

    public function saveTask($id, $username, $email, $task, $isDone, $image)
    {
        $id = $this->db->escape($id);
        $username = $this->db->escape($username);
        $email = $this->db->escape($email);
        $task = $this->db->escape($task);

        $sql = "UPDATE tasks
                    SET username = '{$username}',
                        email = '{$email}',
                        task = '{$task}',
                        is_done = '{$isDone}',
                        image = '{$image}'
                    WHERE id = '{$id}'";

        return $this->db->query($sql);
    }

    public function deleteTask($id)
    {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM tasks 
                    WHERE id = {$id}";

        return $this->db->query($sql);
    }

    public function getImageName($id)
    {
        $id = $this->db->escape($id);
        $sql = "SELECT image FROM tasks 
                    WHERE id = {$id}";

        return $this->db->query($sql);
    }
}