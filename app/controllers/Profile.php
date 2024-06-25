<?php

class Profile extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            // Jika pengguna belum login, arahkan ke halaman login
            header("Location: " . BASEURL . "/auth/login");
            exit();
        } else {
            header("Location: " . BASEURL . "/auth/login");
        }
    }

    public function showMemberProfile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idMember = $_POST['id_member'];
            $data['head'] = 'Detail Anggota';
            $data['current_page'] = 'Profile Member Admin';
            $data['member'] = $this->model('Anggota_model')->getAnggotaById($idMember);
            $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
            $data['kegiatan'] = $this->model('Anggota_model')->getKegiatanByMember($idMember);
            $data['kg'] = $this->model('Anggota_model')->getKegiatanByMember($idMember);
            $this->view('templates/admin/admin_sidebar', $data);
            $this->view('anggota/profile_anggota', $data);
            $this->view('templates/admin/footer_nav');
        }
    }
}
