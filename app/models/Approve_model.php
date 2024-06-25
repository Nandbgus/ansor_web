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
        if (isset($data['id_anggota']) && isset($data['id_kegiatan'])) {
            $this->db->query('SELECT COUNT(*) AS count FROM laporan_kegiatan WHERE id_anggota = :id_anggota AND id_kegiatan = :id_kegiatan');
            $this->db->bind(':id_anggota', $data['id_anggota']);
            $this->db->bind(':id_kegiatan', $data['id_kegiatan']);

            $existingRecord = $this->db->single();

            if ($existingRecord['count'] > 0) {
                $_SESSION['message'] = 'Pendaftaran kegiatan gagal: Anggota sudah terdaftar pada kegiatan ini.';
                $_SESSION['message_type'] = 'error';
                return false;
            }

            $this->db->query('INSERT INTO laporan_kegiatan (id_anggota, id_kegiatan, tanggal_kegiatan) VALUES (:id_anggota, :id_kegiatan, :tanggal_kegiatan)');
            $this->db->bind(':id_anggota', $data['id_anggota']);
            $this->db->bind(':id_kegiatan', $data['id_kegiatan']);
            $this->db->bind(':tanggal_kegiatan', $data['tanggal_kegiatan']);

            if ($this->db->execute()) {
                $_SESSION['message'] = 'Pendaftaran kegiatan berhasil.';
                $_SESSION['message_type'] = 'success';
                return true;
            } else {
                $_SESSION['message'] = 'Terjadi kesalahan saat mendaftarkan kegiatan.';
                $_SESSION['message_type'] = 'error';
                return false;
            }
        }

        $_SESSION['message'] = 'Pendaftaran kegiatan gagal: ' . $data['id_anggota'] . ' atau 
        ' . $data['id_kegiatan'] . ' tidak ditemukan.';
        $_SESSION['message_type'] = 'info';
        return false;
    }


    //Kirim Permintaan Ke Halaman Admin Approve
    public function kirimPermintaanRole($data)
    {
        // Check if the record already exists
        $this->db->query('SELECT COUNT(*) AS count FROM role_approve WHERE id_member = :id_member AND role = :role OR status_verif = "Approve" OR status_verif = "pending"');
        $this->db->bind(':id_member', $data['id_member']);
        $this->db->bind(':role', $data['role']);

        $existingRecord = $this->db->single();

        // If a record exists, return false and set an error message
        if ($existingRecord['count'] > 0) {
            $_SESSION['message'] = 'Kamu sudah mendapatkan role!';
            $_SESSION['message_type'] = 'error';
            return false;
        }

        // If no existing record, proceed with insertion
        $this->db->query('INSERT INTO role_approve (id_member, role) VALUES (:id_member, :role)');
        $this->db->bind(':id_member', $data['id_member']);
        $this->db->bind(':role', $data['role']);

        if ($this->db->execute()) {
            $_SESSION['message'] = 'Berhasil Meminta Role : ' . $data['role'] . '!';
            $_SESSION['message_type'] = 'success';
            return true;
        } else {
            $_SESSION['message'] = 'Gagal Mengirim Permintaan Role !';
            $_SESSION['message_type'] = 'error';
            return false;
        }
    }

    public function getAllRequestSertif()
    {
        $this->db->query('SELECT  laporan_kegiatan.*, kegiatan.nama, members.nama_a as nama_anggota FROM laporan_kegiatan JOIN kegiatan ON kegiatan.id_kegiatan = laporan_kegiatan.id_kegiatan JOIN members ON members.id = laporan_kegiatan.id_anggota WHERE laporan_kegiatan.status_verif = "pending"');

        return $this->db->resultSet();
    }

    // public function getAllRequestSertifID($id)
    // {
    //     $this->db->query('SELECT COUNT(*) AS jumlah FROM laporan_kegiatan WHERE id_anggota = :id');
    //     $this->db->bind(':id', $id);
    //     return $this->db->single();
    // }

    public function getAllRequestRole()
    {
        //role ansor, rja, banser
        $this->db->query('SELECT ra.*, sk.nama_keanggotaan, m.nama_a FROM role_approve ra JOIN status_keanggotaan sk ON sk.id = ra.role JOIN members m ON m.id = ra.id_member WHERE ra.status_verif ="pending"');
        //belum selesai
        return $this->db->resultSet();
    }

    public function getRequestRolewithID($id)
    {
        //role ansor, rja, banser
        $this->db->query('SELECT * FROM role_approve WHERE id_member = :id LIMIT 1');
        $this->db->bind('id', $id);
        //belum selesai
        return $this->db->resultSet();
    }

    public function updatePermintaanRole($id, $role)
    {
        $this->db->query('UPDATE role_approve SET role = :role, status_verif = "pending" WHERE id_role = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':role', $role);

        return $this->db->execute();
    }
    public function updateStatus($id, $status)
    {
        //update status Sertifikat Laporan kegiatan
        $this->db->query('UPDATE laporan_kegiatan SET status_verif = :status WHERE id_laporan = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateStatusRole($id, $status)
    {
        //update status Role Status Keanggotaan
        $this->db->query('UPDATE role_approve SET status_verif = :status WHERE id_role = :id');
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
