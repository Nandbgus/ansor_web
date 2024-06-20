<?php

class Blog extends Controller
{

    public function index()
    {
        $data['head'] = "Blog";
        $data['current_page'] = "Blog";

        // Pagination setup
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Halaman saat ini, default ke 1 jika tidak ada
        $itemsPerPage = 6; // Jumlah item per halaman

        // Ambil nilai pencarian dari input pengguna
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
        $categoryFilter = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : '';

        // Mengambil data blog untuk halaman yang diminta
        $offset = ($currentPage - 1) * $itemsPerPage;
        $data['isi'] = $this->model('Blog_model')->getAllBlogsPaginated($searchQuery, $categoryFilter, $itemsPerPage, $offset);

        // Menghitung total jumlah blog
        $totalBlogs = $this->model('Blog_model')->countAllBlogs($searchQuery, $categoryFilter);
        $totalPages = ceil($totalBlogs / $itemsPerPage);

        // Jika permintaan adalah AJAX, respons dengan JSON
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'isi' => $data['isi'],
                'totalPages' => $totalPages,
                'currentPage' => $currentPage
            ]);
            exit;
        }

        $data['kategories'] = $this->model('Blog_model')->getKategories();
        if (isset($_SESSION['user_id'])) {
            $data['foto'] = $this->model('User_model')->getProfilePhoto($_SESSION['user_id']);
        } else {
            $data['foto'] = ''; // Handle case when user is not logged in
        }

        // Data untuk pagination
        $data['currentPage'] = $currentPage;
        $data['totalPages'] = $totalPages;

        $this->view('templates/header', $data);
        $this->view('blogs/index', $data);
        $this->view('templates/footer', $data);
    }




    public function tambah_blog()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Memeriksa apakah data yang diperlukan tersedia
            if (isset($_POST['judul']) && isset($_POST['body']) && isset($_POST['kategori'])) {
                // Simpan data yang diterima ke variabel
                $judul = $_POST['judul'];
                $body = $_POST['body'];
                $foto = $_FILES['foto'];
                $kategori = $_POST['kategori'];

                // Mendapatkan id author dari sesi
                $author = $_SESSION['user_id'];

                $uploadDir = 'F:\WebServer\laragon\www\ansor\public\img\blog/';
                $fileName = basename($foto['name']);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                // Validasi file
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($fileType, $allowTypes)) {
                    // Upload file ke server
                    if (move_uploaded_file($foto['tmp_name'], $targetFilePath)) {
                        // Memanggil model untuk menyimpan data blog
                        $this->model('Blog_model')->tambah_blog($judul, $body, $fileName, $kategori, $author);

                        // Setelah data berhasil disimpan, lakukan pengalihan halaman atau tindakan lain yang sesuai
                        header('Location: ' . BASEURL . '/admin/form_blogs');
                    } else {
                        // Jika upload gagal
                        die('Gagal mengunggah foto.');
                    }
                } else {
                    // Jika tipe file tidak diizinkan
                    die('Tipe file tidak diizinkan.');
                }
            } else {
                // Jika data yang diperlukan tidak tersedia
                die('Data tidak lengkap.');
            }
        }
    }

    public function detail_blog()
    {
        // Pastikan parameter URL tersedia
        if (isset($_GET['id'])) {
            // Mendapatkan parameter URL
            $id_blog = $_GET['id'];

            $data['blog'] = $this->model('Blog_model')->blogSelect($id_blog);
            $data['head'] = "Detail Blog";
            $this->view('templates/anggota/anggota_header', $data);
            $this->view('blogs/detail_blog', $data);
            $this->view('templates/anggota/anggota_footer');
        }
    }
}
