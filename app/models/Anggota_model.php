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
        SELECT m.id id_member, m.nama_a, m.no_hp, d.nama as nama_dusun, m.rt, dsa.nama as nama_desa, 
               sk.nama_keanggotaan, ra.status_verif
        FROM ' . $this->table . ' m
        JOIN dusun d ON m.id_dusun = d.id_dusun 
        JOIN desa dsa ON d.id_desa = dsa.id
        LEFT JOIN role_approve ra ON m.id = ra.id_member
        LEFT JOIN status_keanggotaan sk ON ra.role = sk.id
    ');
            $results = $this->db->resultSet();

            foreach ($results as &$result) {
                if ($result['status_verif'] === 'rejected') {
                    $result['nama_keanggotaan'] = null;
                } elseif ($result['status_verif'] === 'pending') {
                    $result['nama_keanggotaan'] .= '';
                }
            }

            return $results;
        }

        public function tambah_anggota($data)
        {
            try {
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
                        'is_admin' => 0 // Set default user as non-admin
                    ];
                    if ($this->userModel->tambah_user($userData)) {
                        $_SESSION['message'] = 'Anggota berhasil ditambahkan';
                        $_SESSION['message_type'] = 'success';
                        return true;
                    } else {
                        throw new Exception('Gagal menambahkan user.');
                    }
                } else {
                    throw new Exception('Gagal menambahkan anggota.');
                }
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) { // 23000 adalah kode SQLSTATE untuk pelanggaran integritas (termasuk duplikasi kunci utama)
                    $_SESSION['message'] = 'Gagal karena ID anggota sudah ada!';
                    $_SESSION['message_type'] = 'error';
                } else {
                    $_SESSION['message'] = 'Terjadi kesalahan: ' . $e->getMessage();
                    $_SESSION['message_type'] = 'error';
                }
                return false;
            } catch (Exception $e) {
                $_SESSION['message'] = $e->getMessage();
                $_SESSION['message_type'] = 'error';
                return false;
            }
        }


        public function getLastIdAnggota()
        {
            $this->db->query('SELECT id FROM ' . $this->table . ' ORDER BY current_add DESC LIMIT 1');
            return $this->db->single();
        }

        public function getAnggotaById($id)
        {
            $this->db->query('
             SELECT m.nama_a, m.no_hp, d.nama as nama_dusun, m.rt, dsa.nama as nama_desa, sk.nama_keanggotaan, m.foto, k.nama as nama_kegiatan, ra.status_verif
            FROM ' . $this->table . ' m
            JOIN dusun d ON m.id_dusun = d.id_dusun 
            JOIN desa dsa ON d.id_desa = dsa.id
            LEFT JOIN role_approve ra ON ra.id_member = m.id
            LEFT JOIN status_keanggotaan sk ON ra.role = sk.id
            LEFT JOIN laporan_kegiatan lk ON m.id = lk.id_anggota
            LEFT JOIN kegiatan k ON lk.id_kegiatan = k.id_kegiatan
            WHERE m.id = :id
        ');
            $this->db->bind(':id', $id);
            $result = $this->db->single();

            if ($result) {
                if ($result['status_verif'] === 'rejected') {
                    $result['nama_keanggotaan'] = null;
                } elseif ($result['status_verif'] === 'pending') {
                    $result['nama_keanggotaan'] .= '(pending)';
                }
            }

            return $result;
        }

        public function getAllKegiatan()
        {
            $this->db->query("SELECT * FROM kegiatan");
            return $this->db->resultSet();
        }

        public function getJumlahMemberByDusun()
        {
            $this->db->query("CALL getAllMemberCountsDusun()");
            return $this->db->resultSet();
        }

        public function getJumlahMemberApprove()
        {
            $this->db->query("CALL getCountsMemberApprove()");
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

            // Mendapatkan total kegiatan dengan status 'approved'
            $this->db->query("SELECT 
        COUNT(*) AS total_kegiatan_approved
    FROM 
        laporan_kegiatan
    WHERE 
        id_anggota = :id AND status_verif = 'approve'");
            $this->db->bind(':id', $idMember);
            $totalKegiatanApproved = $this->db->single();

            // Menggabungkan hasil ke dalam satu array
            return [
                'kegiatanList' => $kegiatanList,
                'totalKegiatan' => $totalKegiatan['total_kegiatan'],
                'totalKegiatanApproved' => $totalKegiatanApproved['total_kegiatan_approved']
            ];
        }

        public function saveFotoSertifikat($userId, $photoFile, $idKegiatan, $laporanID)
        {
            // Path penyimpanan foto
            $uploadDir = 'F:/WebServer/laragon/www/ansor/public/img/sertifikat/';

            // Periksa apakah foto sudah diunggah dengan benar
            if ($photoFile['error'] === UPLOAD_ERR_OK) {
                // Tentukan nama file baru
                $photoFileName =  substr($userId, -2) . '_' . $idKegiatan . '.jpg';
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
