<?php

class Blog extends Controller
{

    public function index()
    {
        $data['head'] = "Blog";
        $data['isi'] = $this->model('Blog_model')->isiSemua();
        $this->view('templates/header', $data);
        $this->view('blogs/index', $data);
        $this->view('templates/footer');
    }

    public function tambah_blog()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Memeriksa apakah data yang diperlukan tersedia
            if (isset($_POST['judul']) && isset($_POST['body']) && isset($_POST['kategori'])) {
                // Simpan data yang diterima ke variabel
                $judul = $_POST['judul'];
                $body = $_POST['body'];
                $kategori = $_POST['kategori'];

                // Mendapatkan id author dari sesi
                $author = $_SESSION['user_id'];

                // Memanggil model untuk menyimpan data blog
                $this->model('Blog_model')->tambah_blog($judul, $body, $kategori, $author);

                // Setelah data berhasil disimpan, lakukan pengalihan halaman atau tindakan lain yang sesuai
                // Misalnya, Anda bisa mengalihkan pengguna ke halaman tertentu
                header('Location: ' . BASEURL . '/admin/form_blogs');
                // exit();
            } else {
                // Jika data yang diperlukan tidak tersedia, lakukan tindakan yang sesuai
                // Misalnya, Anda bisa menampilkan pesan kesalahan atau mengarahkan pengguna ke halaman yang sesuai
                // header("Location: halaman_error.php");
                // exit();
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
