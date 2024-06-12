<?php

class Anggota_model extends Controller
{
    private $table = 'members';
    private $db;
    public $id;
    private $userModel;

    public function __construct()
    {
        $this->db = new Database;
        $this->userModel = $this->model('User_model'); // Memuat model User_model
    }

    public function list_anggota()
    {
        $this->db->query('
            SELECT m.id id_member, sk.nama_keanggotaan, m.nama_a, m.no_hp, d.nama as nama_dusun, m.rt, dsa.nama as nama_desa
            FROM ' . $this->table . ' m
            JOIN dusun d ON m.id_dusun = d.id_dusun 
            JOIN desa dsa ON d.id_desa = dsa.id
            LEFT JOIN status_keanggotaan sk ON m.id_status = sk.id
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
        if ($this->db->execute()) {
            // Tambahkan ke tabel users
            $userData = [
                'id' => $data['id'],
                'password' => password_hash($data['id'], PASSWORD_DEFAULT), // Hash password
                'email' => '', // Contoh email
                'is_admin' => 0 // Set default user as non-admin
            ];
            return $this->userModel->tambah_user($userData);
        }
        return false;
    }

    public function getLastIdAnggota()
    {
        $this->db->query('SELECT id FROM ' . $this->table . ' ORDER BY id DESC LIMIT 1');
        return $this->db->single();
    }

    public function getAnggotaById($id)
    {
        $this->db->query('
        SELECT m.nama_a, m.no_hp, d.nama as nama_dusun, m.rt, dsa.nama as nama_desa, sk.nama_keanggotaan, m.foto, k.nama as nama_kegiatan
        FROM ' . $this->table . ' m
        JOIN dusun d ON m.id_dusun = d.id_dusun 
        JOIN desa dsa ON d.id_desa = dsa.id
        LEFT JOIN status_keanggotaan sk ON m.id_status = sk.id
        LEFT JOIN laporan_kegiatan lk ON m.id = lk.id_anggota
        LEFT JOIN kegiatan k ON lk.id_kegiatan = k.id_kegiatan
        WHERE m.id = :id
    ');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }


    public function getKegiatanByMemberId($idMember)
    {
        $this->db->query("SELECT 
                kegiatan.nama AS nama_kegiatan
            FROM 
                laporan_kegiatan
            JOIN 
                kegiatan ON laporan_kegiatan.id_kegiatan = kegiatan.id_kegiatan
            WHERE 
                laporan_kegiatan.id_anggota = :id");
        $this->db->bind(':id', $idMember);
        return $this->db->resultSet();
    }

    public function update_status($id, $status)
    {
        $this->db->query('UPDATE ' . $this->table . ' SET id_status = :status WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }
}
