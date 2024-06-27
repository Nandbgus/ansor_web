<?php

class Admin extends Controller
{
    private $logHelper;
    public function __construct()
    {

        // Panggil fungsi parent __construct untuk melakukan inisialisasi
        parent::__construct();

        // Lakukan pengecekan session di sini
        // Jika pengguna belum login atau bukan admin, maka redirect ke halaman login
        if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
            $_SESSION['message'] = 'Kamu Bukan admin';
            $_SESSION['message_type'] = 'error';
            header('Location: ' . BASEURL . '/auth/login');
            exit(); // Pastikan untuk keluar setelah melakukan redirect
        }

        // Initialize LogHelper
        $this->logHelper = new LogHelper();
    }

    //View Admin
    public function index()
    {
        // Tampilkan halaman 
        $data['head'] = 'Dashboard';
        $data['current_page'] = 'Dashboard';
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['chart'] = $this->model('Anggota_model')->getJumlahMemberByDusun();
        $data['approve'] = $this->model('Anggota_model')->getJumlahMemberApprove();
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('admin/dashboard', $data);
        $this->view('templates/admin/footer_nav');
    }

    public function form_members()
    {
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['head'] = 'Tambah Anggota';
        $data['current_page'] = 'tambah_members';
        $data['lastIdAnggota'] = $this->model('Anggota_model')->getLastIdAnggota();
        $data['dusun'] = $this->model('Daerah_model')->dusun_all();
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('anggota/tambah', $data);
        $this->view('templates/admin/footer_nav', $data);
    }

    public function form_blogs()
    {
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['blogs'] = $this->model('Blog_model')->blogsbyID($_SESSION['user_id']);
        $data['total'] = $this->model('Blog_model')->countBlogsByAuthorId($_SESSION['user_id']);
        $data['kategories'] = $this->model('Blog_model')->getKategories();
        $data['head'] = 'Tambah Blogs';
        $data['current_page'] = 'tambah_blogs';
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('blogs/tambah', $data);
        $this->view('templates/admin/blog_footer');
    }

    public function daftar_anggota()
    {
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['head'] = 'Daftar Anggota';
        $data['members'] = $this->model('Anggota_model')->list_anggota();
        $data['current_page'] = 'daftar_anggota';
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('admin/daftar_anggota', $data);
        $this->view('templates/admin/footer_nav');
    }

    // public function log_admin()
    // {
    //     $data['head'] = "Laporan Aktivitas Admin";
    //     $data['current_page'] = 'log_admin';
    //     $data['logs'] = $this->model('Log_model')->report_all();
    //     $this->view('templates/admin/admin_sidebar', $data);
    //     $this->view('admin/reports', $data);
    //     $this->view('templates/admin/footer_nav');
    // }
    public function reports()
    {
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['head'] = 'Laporan Aktivitas';
        $data['members'] = $this->model('Anggota_model')->list_anggota();
        $data['logs'] = $this->model('Log_model')->report_all();
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
                $this->logHelper->log($data['id'], "Menambahkan Anggota dengan nama:" . $data['nama_a']);
                header('Location: ' . BASEURL . '/admin/daftar_anggota');
            } else {
                header('Location: ' . BASEURL . '/admin/form_members');
            }
            exit();
        }
    }
}
