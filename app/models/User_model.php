<?php

class User_model
{
    private $db;
    private $table = 'users';

    public $id;
    public $password;
    public $is_admin;

    // Table Members
    public $nama_a;
    public $no_hp;
    public $id_dusun;
    public $rt;

    public function __construct() // Dependency injection for DB connection
    {
        $this->db = new Database;
    }


    // public function register()
    // {
    //     $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

    //     $this->db->query("INSERT INTO " . $this->table . " (name,email, password, is_admin) VALUES (:name, :email, :password, :is_admin)");

    //     $this->db->bind(':name', $this->name);
    //     $this->db->bind(':email', $this->email);
    //     $this->db->bind(':password', $hashed_password);
    //     $this->db->bind(':is_admin', $this->is_admin);

    //     // Execute the query and check for errors
    //     try {
    //         $this->db->execute();
    //         echo "Data inserted successfully";
    //         return true;
    //     } catch (PDOException $e) {
    //         echo "Error inserting data: " . $e->getMessage();
    //         return false;
    //     }
    // }

    public function login()
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
        $this->db->bind(':id', $this->id);

        $row = $this->db->single();

        if ($row && $this->password === $row['password']) {
            // Set user properties
            $this->id = $row['id'];
            $this->is_admin = $row['is_admin'];

            // Query untuk mendapatkan data tambahan dari tabel members berdasarkan id_members
            $this->db->query("SELECT * FROM members WHERE id = :id");
            $this->db->bind(':id', $this->id);
            // Check if the user is an admin
            $memberDetails = $this->db->single();

            if ($memberDetails) {
                // Set additional properties from members table
                $this->nama_a = $memberDetails['nama_a'];
                $this->no_hp = $memberDetails['no_hp'];
                $this->id_dusun = $memberDetails['id_dusun'];
                $this->rt = $memberDetails['rt'];


                // Return true if login is successful and member details are fetched
                return true;
            } else {
                // Return false if member details could not be fetched
                return false;
            }

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
