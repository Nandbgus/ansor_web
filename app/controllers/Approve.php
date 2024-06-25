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
        $data['permohonan'] = $this->model('Approve_model')->getAllRequestSertif();
        $data['req_role'] = $this->model('Approve_model')->getAllRequestRole();
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
            $laporanID = substr($data['id_anggota'], -2) . '_' . $tanggalFormat;
            var_dump($laporanID);
            if ($this->model('Approve_model')->kirimPermintaan($data)) {
                $this->model('Anggota_model')->saveFotoSertifikat($data['id_anggota'], $photoFile, $data['id_kegiatan'], $laporanID);
                header("Location: " . BASEURL . "/anggota/sertifikat");
                exit();
            } else {
                header("Location: " . BASEURL . "/anggota/sertifikat");
                exit();
            }
        } else {
            $data = [
                'id_kegiatan' => '',
                'tanggal_kegiatan' => '',
                'foto' => '',
            ];
        }
    }

    public function kirimPermintaanRole()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_member' => $_SESSION['user_id'],
                'role' => $_POST['role']
            ];
            if ($this->model('Approve_model')->kirimPermintaanRole($data)) {
                header('Location: ' . BASEURL . '/anggota/sertifikat');
            } else {
                header('Location: ' . BASEURL . '/anggota/sertifikat');
            }
        }
    }

    public function updatePermintaanRole()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_role' => $_POST['id_role'],
                'role' => $_POST['role']
            ];
            if ($this->model('Approve_model')->updatePermintaanRole($data['id_role'], $data['role'])) {
                $_SESSION['message'] = 'Permintaan perubahan role berhasil dikirim';
                $_SESSION['message_type'] = 'success';
                header('Location: ' . BASEURL . '/anggota');
            } else {
                $_SESSION['message'] = 'Permintaan Gagal';
                $_SESSION['message_type'] = 'error';
                header('Location: ' . BASEURL . '/anggota');
            }
        }
    }


    public function approve_status($id_anggota, $status)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->model('Approve_model')->updateStatus($id_anggota, $status)) {
                $_SESSION['message'] = 'Berhasil Memperbarui';
                $_SESSION['message_type'] = 'success';
                header('Location: ' . BASEURL . '/approve');
            } else {
                $_SESSION['message'] = 'Error';
                $_SESSION['message_type'] = 'error';
                header('Location: ' . BASEURL . '/approve');
            }
            exit;
        }
    }

    public function approve_status_role($id_anggota, $status)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if ($this->model('Approve_model')->updateStatusRole($id_anggota, $status)) {
                $_SESSION['message'] = 'Permintaan Disetujui';
                $_SESSION['message_type'] = 'success';
                header('Location: ' . BASEURL . '/approve');
            } else {
                $_SESSION['message'] = 'Permintaan Ditolak';
                $_SESSION['message_type'] = 'error';
                header('Location: ' . BASEURL . '/approve');
            }
            exit;
        }
    }
}
