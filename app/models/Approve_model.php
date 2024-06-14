<?php

class Approve_model extends Controller
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function kirimPermintaan($data)
    {

        $this->db->query('INSERT INTO laporan_kegiatan (id_anggota, id_kegiatan, tanggal_kegiatan) VALUES (:id_anggota, :id_kegiatan, :tanggal_kegiatan)');
        $this->db->bind(':id_anggota', $data['id_anggota']);
        $this->db->bind(':id_kegiatan', $data['id_kegiatan']);
        $this->db->bind(':tanggal_kegiatan', $data['tanggal_kegiatan']);

        return $this->db->execute();
    }

    public function getAllRequest()
    {
        $this->db->query('SELECT laporan_kegiatan.*, kegiatan.nama, members.nama_a as nama_anggota FROM laporan_kegiatan JOIN kegiatan ON kegiatan.id_kegiatan = laporan_kegiatan.id_kegiatan JOIN members ON members.id = laporan_kegiatan.id_anggota WHERE laporan_kegiatan.status_verif = "pending"');

        return $this->db->resultSet();
    }

    public function getAllRequestRole()
    {
        //role ansor, rja, banser
    }

    public function updateStatus($id, $status)
    {
        $this->db->query('UPDATE laporan_kegiatan SET status_verif = :status WHERE id_laporan = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
