<?php

class Anggota extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            // Jika pengguna belum login, arahkan ke halaman login
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }
        $data['head'] = "Dashboard Anggota";
        $data['current_page'] = "Dashboard";
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['diri'] = $this->model('Anggota_model')->getAnggotaById($_SESSION['user_id']);
        $this->view('templates/anggota/anggota_header', $data);
        $this->view('templates/anggota/nav_dash', $data);
        $this->view('anggota/dashboard', $data);
        $this->view('templates/anggota/anggota_footer');
    }

    public function profile()
    {
        $data['head'] = "User Profile";
        $data['current_page'] = "Profile_anggota";
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['diri'] = $this->model('Anggota_model')->getAnggotaById($_SESSION['user_id']);
        $data['kg'] = $this->model('Anggota_model')->getKegiatanByMember($_SESSION['user_id']);
        $this->view('templates/anggota/anggota_header', $data);
        $this->view('templates/anggota/nav_dash', $data);
        $this->view('auth/profile', $data);
        $this->view('templates/anggota/anggota_footer');
    }

    // Controller
    public function uploadProfilePhoto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
            // Pastikan pengguna sudah login
            if (!isset($_SESSION['user_id'])) {
                header("Location: " . BASEURL . "/auth/login");
                exit();
            }

            // Tangani unggahan foto
            $userId = $_SESSION['user_id'];
            $username = $_SESSION['username'];
            $photoFile = $_FILES['foto'];

            // Panggil model User untuk menyimpan foto
            $result = $this->model('User_model')->saveProfilePhoto($userId, $username, $photoFile);

            // Redirect ke halaman profil setelah selesai
            if ($result) {
                if ($_SESSION['is_admin']) {
                    header("Location: " . BASEURL . "/auth/profile");
                    exit();
                } else {
                    header("Location: " . BASEURL . "/anggota/profile");
                }
            } else {
                echo "Gagal mengunggah foto profil.";
            }
        }
    }

    public function sertifikat()
    {
        $data['head'] = "Sertifikat Anggota";
        $data['current_page'] = "sertifikat_anggota";
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['diri'] = $this->model('Anggota_model')->getAnggotaById($_SESSION['user_id']);
        $kg = $this->model('Anggota_model')->getKegiatanByMember($_SESSION['user_id']);
        $kg['kegiatan'] = $this->model('Anggota_model')->getAllKegiatan();
        $this->view('templates/anggota/anggota_header', $data);
        $this->view('templates/anggota/nav_dash', $data);
        $this->view('anggota/report_sertifikat', $kg);
        $this->view('templates/anggota/anggota_footer');
    }
}
