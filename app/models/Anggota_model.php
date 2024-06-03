<?php

class Anggota_model extends Controller
{
    private $table = 'members';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function list_anggota()
    {
        $this->db->query('
            SELECT m.nama_a, m.no_hp, d.nama as nama_dusun, m.rt, dsa.nama as nama_desa
            FROM ' . $this->table . ' m
            JOIN dusun d ON m.id_dusun = d.id_dusun 
            JOIN desa dsa ON d.id_desa = dsa.id
        ');
        return $this->db->resultSet();
    }

    public function tambah_anggota($data)
    {
        $this->db->query('
            INSERT INTO ' . $this->table . ' (id, nama_a, no_hp, id_dusun, rt)
            VALUES (:id, :nama_a, :no_hp, :id_dusun, :rt)
        ');

        // Bind data
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nama_a', $data['nama_a']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':id_dusun', $data['id_dusun']);
        $this->db->bind(':rt', $data['rt']);

        // Execute
        return $this->db->execute();
    }

    public function getLastIdAnggota()
    {
        $this->db->query('SELECT id FROM ' . $this->table . ' ORDER BY id DESC LIMIT 1');
        return $this->db->single();
    }
}
