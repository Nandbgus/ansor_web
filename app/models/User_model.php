<?php

class User_model
{
    private $db;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $is_admin;

    public function __construct() // Dependency injection for DB connection
    {
        $this->db = new Database;
    }


    public function register()
    {
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $this->db->query("INSERT INTO " . $this->table . " (name,email, password, is_admin) VALUES (:name, :email, :password, :is_admin)");

        $this->db->bind(':name', $this->name);
        $this->db->bind(':email', $this->email);
        $this->db->bind(':password', $hashed_password);
        $this->db->bind(':is_admin', $this->is_admin);

        // Execute the query and check for errors
        try {
            $this->db->execute();
            echo "Data inserted successfully";
            return true;
        } catch (PDOException $e) {
            echo "Error inserting data: " . $e->getMessage();
            return false;
        }
    }

    public function login()
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE email = :email");
        $this->db->bind(':email', $this->email);

        $row = $this->db->single();

        if ($row && password_verify($this->password, $row['password'])) {
            // Set user properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->is_admin = $row['is_admin'];

            // Check if the user is an admin
            return true;
        } else {
            // Return false for invalid credentials
            return false;
        }
    }

    public function getUserById()
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
        $this->db->bind(':id', $this->id);
        return $this->db->single();
    }
}
