<?php
class LogHelper
{
    private $db;

    public function __construct()
    {
        // Inisialisasi koneksi database
        $this->db = new Database;
    }

    public function log($id_user, $aktivitas)
    {
        // Memasukkan data log ke dalam tabel log_aktivitas
        $this->db->query("INSERT INTO log_aktivitas (id_user, aktivitas) VALUES (:id_user, :aktivitas)");
        $this->db->bind(':id_user', $id_user);
        $this->db->bind(':aktivitas', $aktivitas);
        $this->db->execute();
    }
}
