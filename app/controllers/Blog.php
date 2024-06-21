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
    private function uploadFoto($foto, $id_blog)
    {
        if ($foto['error'] == 0) {
            $uploadDir = 'F:\WebServer\laragon\www\ansor\public\img\blog/';
            $fileExtension = pathinfo($foto['name'], PATHINFO_EXTENSION);
            $targetFile = $uploadDir . $id_blog . '.' . $fileExtension;

            if (move_uploaded_file($foto['tmp_name'], $targetFile)) {
                return $id_blog . '.' . $fileExtension;
            }
        }
        return null;
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
                $author = $_SESSION['user_id'];

                // Memanggil model untuk menyimpan data blog
                $id_blog = $this->model('Blog_model')->tambah_blog($judul, $body, '', $kategori, $author);

                if ($id_blog) {
                    // Upload foto dengan nama sesuai ID blog
                    $fileName = $this->uploadFoto($foto, $id_blog);

                    if ($fileName) {
                        // Update data blog dengan nama file yang baru diunggah
                        $this->model('Blog_model')->updateBlogFoto($id_blog, $fileName);
                    }

                    // Setelah data berhasil disimpan, lakukan pengalihan halaman atau tindakan lain yang sesuai
                    header('Location: ' . BASEURL . '/admin/form_blogs');
                } else {
                    die('Gagal menyimpan data blog.');
                }
            } else {
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

    public function detail_blog_admin()
    {
        // Pastikan parameter URL tersedia
        if (isset($_GET['id'])) {
            // Mendapatkan parameter URL
            $id_blog = $_GET['id'];
            // Ambil data blog berdasarkan id
            $data['blog'] = $this->model('Blog_model')->blogsbyID($id_blog);
            // Ambil semua kategori
            $data['kategories'] = $this->model('Blog_model')->getKategories();
            $data['blog'] = $this->model('Blog_model')->blogSelect($id_blog);
            $data['head'] = "Detail Blog";
            $this->view('templates/anggota/anggota_header', $data);
            $this->view('blogs/detail_blog_admin', $data);
            $this->view('templates/anggota/anggota_footer');
        }
    }

    public function update_blog()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id_blog = $_POST['id_blog'];
            $judul = $_POST['judul'];
            $body = $_POST['body'];
            // $kategori_ids = isset($_POST['kategori']) ? $_POST['kategori'] : []; // Array of selected categories
            $foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;
            // $kategori_ids = implode(',', $_POST['kategori']); // menggabungkan kategori menjadi string CSV
            $kategori_ids = implode(',', $_POST['kategori']);

            // Upload Foto (jika ada)
            $foto_blogs = $foto ? $this->uploadFoto($foto, $id_blog) : null;

            // Update Blog di Database
            $this->model('Blog_model')->updateBlogWithCategories($id_blog, $judul, $body, $foto_blogs, $kategori_ids);

            // Redirect ke halaman detail blog
            header('Location: ' . BASEURL . '/blog/detail_blog_admin?id=' . $id_blog);
        }
    }


    public function hapus_blog()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_blog = $_POST['id_blog'];
            $this->model('Blog_model')->deleteBlog($id_blog);
            header('Location: ' . BASEURL . '/blog');
        }
    }
}
