<?php

class Admin extends Controller
{
    public function __construct()
    {
        // Panggil fungsi parent __construct untuk melakukan inisialisasi
        parent::__construct();

        // Lakukan pengecekan session di sini
        // Jika pengguna belum login atau bukan admin, maka redirect ke halaman login
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            echo "<script>alert('Kamu Belum Login !!'); window.location='" . BASEURL . "/auth/login'</script>";
            exit(); // Pastikan untuk keluar setelah melakukan redirect
        }
    }

    //View Admin
    public function index()
    {
        // Tampilkan halaman 
        $data['head'] = 'Dashboard';
        $data['current_page'] = 'Dashboard';
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('admin/dashboard');
        $this->view('templates/admin/footer_nav');
    }

    public function form_members()
    {
        $data['head'] = 'Tambah';
        $data['current_page'] = 'tambah_members';
        $data['lastIdAnggota'] = $this->model('Anggota_model')->getLastIdAnggota();
        $data['dusun'] = $this->model('Daerah_model')->dusun_all();
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('anggota/tambah', $data);
        $this->view('templates/admin/footer_nav', $data);
    }

    public function form_blogs()
    {
        $data['head'] = 'Tambah';
        $data['current_page'] = 'tambah_blogs';
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('blogs/tambah');
        $this->view('templates/admin/footer_nav');
    }

    public function daftar_anggota()
    {
        $data['head'] = 'Daftar Anggota';
        $data['members'] = $this->model('Anggota_model')->list_anggota();
        $data['current_page'] = 'daftar_anggota';
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('admin/daftar_anggota', $data);
        $this->view('templates/admin/footer_nav');
    }
    public function reports()
    {
        $data['head'] = 'Laporan';
        $data['members'] = $this->model('Anggota_model')->list_anggota();
        $data['current_page'] = 'reports';
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('admin/reports', $data);
        $this->view('templates/admin/footer_nav');
    }

    //Functions Admin
    public function tambah_anggota()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => trim($_POST['id']),
                'nama_a' => trim($_POST['nama_a']),
                'no_hp' => trim($_POST['no_hp']),
                'id_dusun' => trim($_POST['id_dusun']),
                'rt' => trim($_POST['rt'])
            ];

            if ($this->model('Anggota_model')->tambah_anggota($data)) {
                echo "<script>alert('Anggota berhasil ditambahkan'); window.location='" . BASEURL . "/admin/report'</script>";
            } else {
                echo "<script>alert('Gagal menambahkan anggota'); window.location='" . BASEURL . "/admin/tambah_members'</script>";
            }
        }
    }
}
