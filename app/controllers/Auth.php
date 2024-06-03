<?php

class Auth extends Controller
{

    public function index()
    {
        $data['head'] = "Register";
        $this->view('templates/auth', $data);
        $this->view('auth/register');
        $this->view('templates/footer');
    }

    public function profile()
    {
        $data['head'] = "Profile";
        $this->view('templates/header', $data);
        $this->view('auth/profile');
        $this->view('templates/footer');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari form login
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Panggil model User_model
            $user = $this->model('User_model');
            $user->email = $email;
            $user->password = $password;

            try {
                if ($user->login()) {
                    // Mulai session
                    session_start();

                    // Set session user_id dan is_admin
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['is_admin'] = $user->is_admin;

                    // Simpan informasi pengguna tambahan seperti nama dan foto profil ke dalam session
                    $_SESSION['user_name'] = $user->name;
                    $_SESSION['is_admin'] = $user->is_admin;
                    $_SESSION['user_profile_picture'] = $user->profile_picture;

                    // Redirect ke halaman yang sesuai
                    if ($user->is_admin) {
                        header("Location: " . BASEURL . "/admin/dashboard");
                    } else {
                        header("Location: " . BASEURL . "/home");
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
                    header("Location: " . BASEURL . "/anggota/index");
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
