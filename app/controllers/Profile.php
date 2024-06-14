<?php

class Profile extends Controller
{
    public function index()
    {
    }

    public function showMemberProfile()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idMember = $_POST['id_member'];
            $data['head'] = 'Detail Anggota';
            $data['current_page'] = 'Profile Member Admin';
            $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
            $data['kegiatan'] = $this->model('Anggota_model')->getKegiatanByMember($idMember);
            $data['member'] = $this->model('Anggota_model')->getAnggotaById($idMember);
            $data['kg'] = $this->model('Anggota_model')->getKegiatanByMember($idMember);
            $this->view('templates/admin/admin_sidebar', $data);
            $this->view('anggota/profile_anggota', $data);
            $this->view('templates/admin/footer_nav');
        }
    }
}
