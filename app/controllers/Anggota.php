<?php

class Anggota extends Controller
{
    public function index()
    {
        $data['head'] = "Dashboard Anggota";
        $data['current_page'] = "Dashboard Anggota";
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
        $data['kegiatan'] = $this->model('User_model')->semua_kegiatan();
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
            $photoFile = $_FILES['foto'];

            // Panggil model User untuk menyimpan foto
            $result = $this->model('User_model')->saveProfilePhoto($userId, $photoFile);

            // Redirect ke halaman profil setelah selesai
            if ($result) {
                header("Location: " . BASEURL . "/auth/profile");
                exit();
            } else {
                echo "Gagal mengunggah foto profil.";
            }
        }
    }
}
