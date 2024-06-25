<?php

class Auth extends Controller
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



    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mulai session
            session_start();
            // Ambil data dari form login
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Panggil model User_model
            $user = $this->model('User_model');
            $user->username = $username;
            $user->password = $password;
            try {
                if ($user->login()) {

                    // Simpan informasi dasar ke session
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['username'] = $user->username;
                    $_SESSION['is_admin'] = $user->is_admin;

                    // Ambil informasi tambahan dari tabel members menggunakan id
                    if ($user->getBio($user->id)) {
                        // Simpan informasi tambahan ke session
                        $_SESSION['user_name'] = $user->nama_a;
                        $_SESSION['no_hp'] = $user->no_hp;
                        $_SESSION['status'] = $user->nama_status;
                        $_SESSION['desa'] = $user->nama_desa;
                        $_SESSION['dusun'] = $user->nama_dusun;
                        $_SESSION['rt'] = $user->rt;
                        $_SESSION['nama_kegiatan'] = $user->nama_kegiatan;
                        $_SESSION['user_profile_picture'] = $user->foto;
                    }

                    // Redirect ke halaman yang sesuai
                    if ($user->is_admin) {
                        header("Location: " . BASEURL . "/admin/dashboard");
                    } else {
                        header("Location: " . BASEURL . "/anggota");
                    }
                    exit();
                } else {
                    echo 'Login failed. Please check your email and password.';
                }
            } catch (Exception $e) {
                echo 'Login failed: ' . $e->getMessage();
            }
        } else {
            // Jika sudah login, redirect ke halaman yang sesuai
            if (isset($_SESSION['user_id'])) {
                if ($_SESSION['is_admin']) {
                    header("Location: " . BASEURL . "/admin/dashboard");
                } else {
                    header("Location: " . BASEURL . "/anggota");
                }
                exit();
            }

            $data['head'] = "Login";
            $this->view('templates/auth', $data);
            $this->view('auth/login');
            $this->view('templates/footer');
        }
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->model('User_model');
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
            $user->is_admin = isset($_POST['is_admin']) ? 1 : 0;

            // Debugging: Dump user object before registration
            if ($user->register()) {
                header('Location: ' . BASEURL . '/auth/login');
            } else {
                echo 'Registration failed in Auth controller';
            }
        } else {
            $this->index();
        }
    }

    public function profile()
    {

        if (!isset($_SESSION['user_id'])) {
            // Jika pengguna belum login, arahkan ke halaman login
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }

        // Assuming User_model is already loaded
        $userModel = $this->model('User_model');
        $userModel->id = $_SESSION['user_id'];

        if ($_SESSION['is_admin']) {
            // Jika pengguna adalah admin, arahkan ke tampilan admin
            $data['head'] = "Admin Profile";
            $data['kegiatan'] = $userModel->semua_kegiatan();
            $data['diri'] = $this->model('Anggota_model')->getAnggotaById($_SESSION['user_id']);
            $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
            $data['kg'] = $this->model('Anggota_model')->getKegiatanByMember($_SESSION['user_id']);
            $data['current_page'] = 'profile_admin';
            $this->view('templates/admin/admin_sidebar', $data);
            $this->view('auth/profile', $data);
            $this->view('templates/admin/footer_nav');

            // Debugging: var_dump data kegiatan dan data pengguna
        } else {
            // Jika pengguna bukan admin, arahkan ke tampilan pengguna biasa
            $data['head'] = "User Profile";
            $data['current_page'] = "Profile_anggota";
            $data['kegiatan'] = $userModel->semua_kegiatan();
            $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
            $data['diri'] = $this->model('Anggota_model')->getAnggotaById($_SESSION['user_id']);
            $data['kg'] = $this->model('Anggota_model')->getKegiatanByMember($_SESSION['user_id']);
            $this->view('templates/anggota/anggota_header', $data);
            $this->view('templates/anggota/nav_dash', $data);
            $this->view('auth/profile', $data);
            $this->view('templates/anggota/anggota_footer');
        }
    }

    public function setting()
    {
        if (!isset($_SESSION['user_id'])) {
            // Jika pengguna belum login, arahkan ke halaman login
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }

        // Assuming User_model is already loaded
        $userModel = $this->model('User_model');
        $userModel->id = $_SESSION['user_id'];


        if ($_SESSION['is_admin']) {
            // Jika pengguna adalah admin, arahkan ke tampilan admin
            $data['head'] = "Setting Admin Profile";
            $data['kegiatan'] = $userModel->semua_kegiatan();
            $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
            $data['kg'] = $this->model('Anggota_model')->getKegiatanByMember($_SESSION['user_id']);
            $data['current_page'] = 'setting_admin';
            $this->view('templates/admin/admin_sidebar', $data);
            $this->view('auth/setting_profile', $data);
            $this->view('templates/admin/footer_nav');

            // Debugging: var_dump data kegiatan dan data pengguna
        } else {
            // Jika pengguna bukan admin, arahkan ke tampilan pengguna biasa
            $data['head'] = "SettingUser Profile";
            $data['current_page'] = "Profile_anggota";
            $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
            $data['diri'] = $this->model('Anggota_model')->getAnggotaById($_SESSION['user_id']);
            $data['kg'] = $this->model('Anggota_model')->getKegiatanByMember($_SESSION['user_id']);
            $this->view('templates/anggota/anggota_header', $data);
            $this->view('templates/anggota/nav_dash', $data);
            $this->view('auth/setting_profile', $data);
            $this->view('templates/anggota/anggota_footer');
        }
    }

    public function profileUpdate()
    {
        //Untuk Update Biodata Username dan Password
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $newUsername = $_POST['username'];
            $newPassword = $_POST['password'];

            // Load the User model
            $userModel = $this->model('User_model');
            $result = $userModel->updateProfile($userId, $newUsername, $newPassword);

            if ($result) {
                // Update session username
                $_SESSION['username'] = $newUsername;

                $_SESSION['message'] = 'Username dan Password Berhasil Dirubah';
                $_SESSION['message_type'] = 'success';
                // Redirect to profile page with success message
                header("Location: " . BASEURL . "/auth/setting");
                exit();
            } else {
                $_SESSION['message'] = 'Username dan Password Gagal Dirubah';
                $_SESSION['message_type'] = 'error';
                // Redirect to profile page with error message
                header("Location: " . BASEURL . "/auth/setting");
                exit();
            }
        } else {
            // Load the profile update form
            $data['head'] = "Update Profile";
            $this->view('templates/header', $data);
            $this->view('auth/profile_update', $data);
            $this->view('templates/footer');
        }
    }
    public function logout()
    {
        // Mulai session
        session_start();

        // Hapus semua data session
        $_SESSION = [];

        // Hancurkan session
        session_destroy();

        // Redirect ke halaman login setelah logout
        header("Location: " . BASEURL . "/home");
        exit();
    }
}
