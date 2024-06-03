<?php

class Blog_model
{
    private $table = 'blogs';
    private $db;

    

    public function __construct()
    {
        $this->db = new Database;
    }


    public function isiSemua()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}
