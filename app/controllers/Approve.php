<?php
class Approve extends Controller
{
    public function index()
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            // If not logged in, redirect to the login page
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
        
        $data['head'] = "Halaman Approve";
        $data['anggota'] = $this->model('Anggota_model')->list_anggota();
        $this->view('templates/anggota/anggota_header', $data);
        $this->view('admin/approve_member', $data);
        $this->view('templates/anggota/anggota_footer');
    }

    public function approve_status()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
            $id = $_POST['id'];
            $status = $_POST['status'];

            echo "ID: " . $id . "<br>";
            echo "status: " . $status . "<br>";
            $this->model('Anggota_model')->update_status($id, $status);

            header('Location: ' . BASEURL . '/approve');
            exit;
        }
    }
}
