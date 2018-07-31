<?php

class Book extends Model
{
    public function getBookList($name)
    {
        $sql = "
              SELECT a.{$name} as book,
                     GROUP_CONCAT(c.{$name}) as authors
              FROM books a
                  INNER JOIN authors_books b
                      ON a.id = b.book_id
                  INNER JOIN authors c
                      ON b.author_id = c.id
              GROUP BY a.{$name}
        ";

        return $this->db->query($sql);
    }
}