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
            $data['kegiatan'] = $this->model('Anggota_model')->getKegiatanByMemberId($idMember);
            $data['member'] = $this->model('Anggota_model')->getAnggotaById($idMember);
            $this->view('templates/anggota/anggota_header', $data);
            $this->view('anggota/profile_anggota', $data);
            $this->view('templates/anggota/anggota_footer', $data);
        }
    }
}
