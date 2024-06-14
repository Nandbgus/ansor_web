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
        $data['current_page'] = 'approve';
        $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        $data['anggota'] = $this->model('Anggota_model')->list_anggota();
        $data['permohonan'] = $this->model('Approve_model')->getAllRequest();
        $this->view('templates/admin/admin_sidebar', $data);
        $this->view('admin/approve_member', $data);
        $this->view('templates/admin/footer_nav');
    }

    public function kirimPermintaan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
            $data = [
                'id_anggota' => $_SESSION['user_id'],
                'id_kegiatan' => trim($_POST['id_kegiatan']),
                'tanggal_kegiatan' => trim($_POST['tanggal_kegiatan']),
            ];
            $photoFile = $_FILES['foto'];
            $tanggalFormat = date('Ymd', strtotime($data['tanggal_kegiatan']));
            $laporanID = $data['id_anggota'] . '_' . $tanggalFormat;
            var_dump($laporanID);
            if ($this->model('Approve_model')->kirimPermintaan($data)) {
                $this->model('Anggota_model')->saveFotoSertifikat($data['id_anggota'], $photoFile, $data['id_kegiatan'], $laporanID);
                header(BASEURL . 'anggota/sertifikat');
            } else {
                die('ada yang salah');
                var_dump('error ');
            }
        } else {
            $data = [
                'id_kegiatan' => '',
                'tanggal_kegiatan' => '',
                'foto' => '',
            ];
        }
    }

    public function approve_status($id_anggota, $status)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('Approve_model')->updateStatus($id_anggota, $status)) {
                header('Location: ' . BASEURL . '/approve');
            } else {
                die("An error has occurred");
            }
            exit;
        }
    }
}
