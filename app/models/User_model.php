<?php

class User_model extends Controller
{
    private $db;
    private $table = 'users';

    public $id;
    public $username;
    public $password;
    public $is_admin;

    // Table Members
    public $nama_a;
    public $no_hp;
    public $last_login;
    public $id_dusun;
    public $id_status;
    public $foto;
    public $rt;

    // Additional properties for names
    public $nama_dusun;
    public $nama_status;
    public $nama_desa;
    public $nama_kegiatan;

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
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username = :username");
        $this->db->bind(':username', $this->username);

        $row = $this->db->single();

        if ($row && password_verify($this->password,  $row['password'])) {
            // Set user properties
            $this->db->query('UPDATE members SET last_login = NOW() WHERE id = ?');
            $this->db->bind(1, $row['id']);
            $this->db->execute();
            $this->id = $row['id'];
            $this->username = $row['username'];
            $this->is_admin = $row['is_admin'];
            // Return true if login is successful
            return true;
        } else {
            // Return false for invalid credentials
            return false;
        }
    }

    public function getBio($id)
    {
        $this->db->query("
        SELECT 
            users.id, users.username, users.password, users.is_admin,
            members.nama_a, members.no_hp, members.id_dusun, members.foto, members.rt, members.last_login,
            dusun.nama AS nama_dusun, dusun.id_desa,
            desa.nama AS nama_desa,
            kegiatan.nama AS nama_kegiatan,
            status_keanggotaan.nama_keanggotaan,
            role_approve.status_verif
        FROM users
        JOIN members ON users.id = members.id
        LEFT JOIN dusun ON members.id_dusun = dusun.id_dusun
        LEFT JOIN desa ON dusun.id_desa = desa.id
        LEFT JOIN laporan_kegiatan ON members.id = laporan_kegiatan.id_anggota
        LEFT JOIN kegiatan ON laporan_kegiatan.id_kegiatan = kegiatan.id_kegiatan 
        LEFT JOIN role_approve ON members.id = role_approve.id_member
        LEFT JOIN status_keanggotaan ON role_approve.role = status_keanggotaan.id
        WHERE users.id = :id
    ");
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        if ($row) {
            // Set additional properties from joined tables
            $this->nama_a = $row['nama_a'];
            $this->last_login = $row['last_login'];
            $this->no_hp = $row['no_hp'];
            $this->id_dusun = $row['id_dusun'];
            $this->foto = $row['foto'];
            $this->rt = $row['rt'];
            $this->nama_dusun = $row['nama_dusun'];
            $this->nama_desa = $row['nama_desa'];
            $this->nama_kegiatan = $row['nama_kegiatan'];

            if ($row['status_verif'] === 'rejected') {
                $this->nama_status = null;
            } elseif ($row['status_verif'] === 'pending') {
                $this->nama_status = $row['nama_keanggotaan'] . '(pending)';
            } else {
                $this->nama_status = $row['nama_keanggotaan'];
            }

            // Return true if data retrieval is successful
            return true;
        } else {
            // Return false if data retrieval fails
            return false;
        }
    }


    public function semua_kegiatan()
    {
        $this->db->query("
            SELECT 
                kegiatan.nama AS nama_kegiatan
            FROM 
                laporan_kegiatan
            JOIN 
                kegiatan ON laporan_kegiatan.id_kegiatan = kegiatan.id_kegiatan
            WHERE 
                laporan_kegiatan.id_anggota = :id
        ");
        $this->db->bind(':id', $this->id);

        return $this->db->resultSet();
    }

    public function getUserById()
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
        $this->db->bind(':id', $this->id);
        return $this->db->single();
    }

    // Model
    public function saveProfilePhoto($userId, $username, $photoFile)
    {
        // Tentukan batas ukuran file gambar (dalam byte)
        $maxFileSize = 2 * 1024 * 1024; // Contoh: batas ukuran 2MB

        // Periksa ukuran file
        if ($photoFile['size'] > $maxFileSize) {
            return false; // Jika ukuran melebihi batas, hentikan proses
        }
        // Path penyimpanan foto
        $uploadDir = 'F:\WebServer\laragon\www\ansor\public\img\profile/';

        // Periksa apakah foto sudah diunggah dengan benar
        if ($photoFile['error'] === UPLOAD_ERR_OK) {
            // Tentukan nama file baru
            $last_string = substr($userId, -2);
            $photoFileName = $username . $last_string;

            // Batasi panjang nama file jika lebih dari 100 karakter
            if (strlen($photoFileName) > 8) {
                $photoFileName = substr($photoFileName, 0, 5);
            }

            // Tambahkan ekstensi file (jika perlu)
            $photoFileName .= '.jpg';

            // Simpan foto ke lokasi yang ditentukan
            $targetFilePath = $uploadDir . $photoFileName;
            if (move_uploaded_file($photoFile['tmp_name'], $targetFilePath)) {
                // Perbarui informasi foto pengguna di database
                $this->db->query("UPDATE members SET foto = :photoFileName WHERE id = :id");
                $this->db->bind(':photoFileName', $photoFileName);
                $this->db->bind(':id', $userId);
                $this->db->execute();

                return true;
            }
        }

        return false;
    }

    public function getProfilePhoto($userId)
    {
        $this->db->query("SELECT foto FROM members WHERE id = :userId");
        $this->db->bind(':userId', $userId);
        $result = $this->db->single();
        return $result['foto'];
    }

    public function tambah_user($data)
    {
        $this->db->query('
            INSERT INTO ' . $this->table . ' (id, username, password,  is_admin)
            VALUES (:id,:username, :password,  :is_admin)
        ');

        // Bind data
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':username', $data['id']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':is_admin', $data['is_admin']);

        // Execute
        return $this->db->execute();
    }

    public function updateProfile($userId, $newUsername, $newPassword)
    {
        // Prepare SQL query to update username and password
        $sql = "UPDATE " . $this->table . " SET username = :username, password = :password WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':username', $newUsername);
        $this->db->bind(':password', password_hash($newPassword, PASSWORD_DEFAULT));
        $this->db->bind(':id', $userId);

        // Execute the query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
