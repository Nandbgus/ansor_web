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

    public function getAllKegiatan()
    {
        $this->db->query("SELECT * FROM kegiatan");
        return $this->db->resultSet();
    }



    public function getKegiatanByMember($idMember)
    {
        // menyimpan kegiatan serta total
        $this->db->query("SELECT 
            kegiatan.nama AS nama_kegiatan, laporan_kegiatan.tanggal_kegiatan, laporan_kegiatan.status_verif, laporan_kegiatan.foto
        FROM 
            laporan_kegiatan
        JOIN 
            kegiatan ON laporan_kegiatan.id_kegiatan = kegiatan.id_kegiatan
        WHERE 
            laporan_kegiatan.id_anggota = :id");
        $this->db->bind(':id', $idMember);
        $kegiatanList = $this->db->resultSet();

        // Mendapatkan total kegiatan
        $this->db->query("SELECT 
            COUNT(*) AS total_kegiatan
        FROM 
            laporan_kegiatan
        WHERE 
            id_anggota = :id");
        $this->db->bind(':id', $idMember);
        $totalKegiatan = $this->db->single();

        // Menggabungkan hasil ke dalam satu array
        return [
            'kegiatanList' => $kegiatanList,
            'totalKegiatan' => $totalKegiatan['total_kegiatan']
        ];
    }

    public function saveFotoSertifikat($userId, $photoFile, $idKegiatan, $laporanID)
    {
        // Path penyimpanan foto
        $uploadDir = 'F:\WebServer\laragon\www\ansor\public\img\sertifikat/';

        // Periksa apakah foto sudah diunggah dengan benar
        if ($photoFile['error'] === UPLOAD_ERR_OK) {
            // Tentukan nama file baru
            $photoFileName =  $userId . '_' . $idKegiatan . '.jpg';
            // Simpan foto ke lokasi yang ditentukan
            $targetFilePath = $uploadDir . $photoFileName;
            if (move_uploaded_file($photoFile['tmp_name'], $targetFilePath)) {
                // Perbarui informasi foto pengguna di database
                $this->db->query("UPDATE laporan_kegiatan SET foto = :photoFileName WHERE id_laporan = :id");
                $this->db->bind(':photoFileName', $photoFileName);
                $this->db->bind(':id', $laporanID);
                $this->db->execute();

                header('Location: ' . BASEURL . '/anggota/sertifikat');
                exit();
            }
        }

        return false;
    }


    public function update_status($id, $status)
    {
        $this->db->query('UPDATE ' . $this->table . ' SET id_status = :status WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }
}
