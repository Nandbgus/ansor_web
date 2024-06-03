<?php

class Anggota extends Controller
{
    public function index()
    {
        $data['head'] = "Dashboard Anggota";
        $data['members'] = $this->model('Anggota_model')->list_anggota();
        $this->view('templates/anggota/anggota_header', $data);
        $this->view('anggota/dashboard');
        $this->view('templates/anggota/anggota_footer');
    }
}
