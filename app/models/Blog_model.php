<?php

class Blog_model
{
    private $table = 'blogs';
    private $db;



    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBlogsPaginated($searchQuery, $categoryFilter, $limit, $offset)
    {
        // Query dasar untuk mengambil data blog dengan pagination
        $sql = 'SELECT b.*, m.nama_a 
            FROM ' . $this->table . ' b 
            JOIN members m ON b.id_author = m.id ';

        // Array untuk menyimpan kondisi tambahan query
        $conditions = [];

        // Bind parameters untuk query
        $binds = [
            ':limit' => $limit,
            ':offset' => $offset
        ];

        // Filter berdasarkan pencarian
        if (!empty($searchQuery)) {
            $conditions[] = "(b.judul LIKE :search OR b.body LIKE :search)";
            $binds[':search'] = '%' . $searchQuery . '%';
        }

        // Filter berdasarkan kategori
        if (!empty($categoryFilter)) {
            $conditions[] = "EXISTS (
                            SELECT 1 
                            FROM blog_kategori bk 
                            WHERE bk.id_blog = b.id_blog 
                            AND bk.id_kategori = :category
                        )";
            $binds[':category'] = $categoryFilter;
        }

        // Gabungkan kondisi jika ada
        if (!empty($conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        // Tambahkan ORDER BY dan LIMIT untuk pagination
        $sql .= ' ORDER BY b.time_stamp DESC 
              LIMIT :limit OFFSET :offset';

        // Eksekusi query dengan bind parameters
        $this->db->query($sql);

        // Bind nilai pencarian jika ada
        foreach ($binds as $key => $value) {
            $this->db->bind($key, $value);
        }

        // Ambil hasil query dalam bentuk resultSet
        $blogs = $this->db->resultSet();

        // Ambil kategori untuk setiap blog
        foreach ($blogs as &$blog) {
            $blog['kategories'] = $this->getCategoriesByBlogId($blog['id_blog']);
        }

        // Kembalikan hasil blogs
        return $blogs;
    }

    public function countAllBlogs($searchQuery = '', $categoryFilter = '')
    {
        // Query dasar untuk menghitung total jumlah blog
        $sql = 'SELECT COUNT(*) as total 
            FROM ' . $this->table . ' b ';

        // Array untuk menyimpan kondisi tambahan query
        $conditions = [];

        // Bind parameters untuk query
        $binds = [];

        // Filter berdasarkan pencarian
        if (!empty($searchQuery)) {
            $conditions[] = "(b.judul LIKE :search OR b.body LIKE :search)";
            $binds[':search'] = '%' . $searchQuery . '%';
        }

        // Filter berdasarkan kategori
        if (!empty($categoryFilter)) {
            $conditions[] = "EXISTS (
                            SELECT 1 
                            FROM blog_kategori bk 
                            WHERE bk.id_blog = b.id_blog 
                            AND bk.id_kategori = :category
                        )";
            $binds[':category'] = $categoryFilter;
        }

        // Gabungkan kondisi jika ada
        if (!empty($conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }

        // Eksekusi query dengan bind parameters
        $this->db->query($sql);

        // Bind nilai pencarian jika ada
        foreach ($binds as $key => $value) {
            $this->db->bind($key, $value);
        }

        // Ambil hasil query dalam bentuk single row associative array
        $row = $this->db->single();

        // Kembalikan total jumlah blog
        return $row['total'];
    }

    public function isiSemua()
    {
        $this->db->query('SELECT b.*, m.nama_a FROM ' . $this->table . ' b JOIN members m ON b.id_author = m.id');
        $blogs = $this->db->resultSet();

        foreach ($blogs as &$blog) {
            $blog['kategories'] = $this->getCategoriesByBlogId($blog['id_blog']);
        }

        return $blogs;
    }

    public function blogsbyID($userId)
    {
        $this->db->query('SELECT b.judul, b.body, b.time_stamp, m.nama_a, b.id_blog, b.foto_blogs FROM blogs b JOIN members m ON b.id_author = m.id WHERE b.id_author = :id');
        $this->db->bind(':id', $userId);
        $blogs = $this->db->resultSet();

        foreach ($blogs as &$blog) {
            $blog['kategories'] = $this->getCategoriesByBlogId($blog['id_blog']);
        }

        return $blogs;
    }

    public function getCategoriesByBlogId($blogId)
    {
        $this->db->query('SELECT k.kategori nama_kategori, k.id_kategori FROM kategories k INNER JOIN blog_kategori bk ON k.id_kategori = bk.id_kategori WHERE bk.id_blog = :blog_id ');
        $this->db->bind(':blog_id', $blogId);
        return $this->db->resultSet();
    }

    public function countBlogsByAuthorId($userId)
    {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE id_author = :id');
        $this->db->bind(':id', $userId);
        $result = $this->db->single();

        return $result['total'];
    }

    public function getKategories()
    {
        $this->db->query('SELECT * FROM kategories');
        return $this->db->resultSet();
    }

    // FUngsi Untuk Tambah Blog Baru
    public function tambah_blog($judul, $body, $foto, $kategori, $author)
    {
        // Misalnya, Anda bisa mengatur id_blog secara otomatis dengan mengambil data terakhir dari database
        // dan menambahkan 1 ke nomor id terakhir
        $id_blog = "b" . ($this->getLastBlogId() + 1);

        // Memasukkan data blog ke dalam tabel blog
        $this->db->query("INSERT INTO blogs (id_blog, judul, body, foto_blogs, id_author) VALUES (:id_blog, :judul, :body, :foto_blogs, :id_author)");
        $this->db->bind(':id_blog', $id_blog);
        $this->db->bind(':judul', $judul);
        $this->db->bind(':body', $body);
        $this->db->bind(':foto_blogs', $foto);
        $this->db->bind(':id_author', $author);
        $this->db->execute(); // Menggunakan execute() untuk pernyataan SQL INSERT

        // Memasukkan data kategori blog ke dalam tabel blog_kategori
        $this->db->query("INSERT INTO blog_kategori (id_blog, id_kategori) VALUES (:id_blog, :id_kategori)");
        $this->db->bind(':id_blog', $id_blog);
        $this->db->bind(':id_kategori', $kategori);
        $this->db->execute();

        return $id_blog; // Menggunakan execute() untuk pernyataan SQL INSERT
    }

    // Metode untuk memperbarui foto blog
    public function updateBlogFoto($id_blog, $fileName)
    {
        $this->db->query('UPDATE blogs SET foto_blogs = :foto_blogs WHERE id_blog = :id_blog');
        $this->db->bind(':foto_blogs', $fileName);
        $this->db->bind(':id_blog', $id_blog);
        return $this->db->execute();
    }

    // Fungsi Untuk Update Blog
    public function updateBlogWithCategories($id_blog, $judul, $body, $foto_blogs, $kategori_ids)
    {
        try {
            // Update blog dengan informasi baru
            $sql = "UPDATE blogs SET judul = :judul, body = :body";
            $binds = [
                ':judul' => $judul,
                ':body' => $body,
                ':id_blog' => $id_blog
            ];

            if ($foto_blogs) {
                $sql .= ", foto_blogs = :foto_blogs";
                $binds[':foto_blogs'] = $foto_blogs;
            }

            $sql .= " WHERE id_blog = :id_blog";

            $this->db->query($sql);

            foreach ($binds as $key => $value) {
                $this->db->bind($key, $value);
            }

            $this->db->execute();

            // Pastikan kategori_ids adalah array
            if (!is_array($kategori_ids)) {
                $kategori_ids = explode(',', $kategori_ids);
            }

            // Hilangkan duplikat dari kategori_ids
            $kategori_ids = array_unique($kategori_ids);

            // Update kategori blog
            if ($this->updateBlogCategories($id_blog, $kategori_ids)) {
                $_SESSION['message'] = 'Blog berhasil diperbarui!';
                $_SESSION['message_type'] = 'success';
                return true;
            } else {
                $_SESSION['message'] = 'Gagal memperbarui kategori blog!';
                $_SESSION['message_type'] = 'error';
                return false;
            }
        } catch (Exception $e) {
            $_SESSION['message'] = 'Terjadi kesalahan: ' . $e->getMessage();
            $_SESSION['message_type'] = 'error';
            return false;
        }
    }

    public function updateBlogCategories($id_blog, $kategori_ids)
    {
        try {
            // Hapus semua kategori yang terkait dengan blog
            $this->db->query("DELETE FROM blog_kategori WHERE id_blog = :id_blog");
            $this->db->bind(':id_blog', $id_blog);
            $this->db->execute();

            // Tambahkan kategori baru
            $sql = "INSERT INTO blog_kategori (id_blog, id_kategori) VALUES ";
            $values = [];
            $binds = [':id_blog' => $id_blog];
            foreach ($kategori_ids as $index => $id_kategori) {
                $values[] = "(:id_blog, :id_kategori_{$index})";
                $binds[":id_kategori_{$index}"] = $id_kategori;
            }
            $sql .= implode(", ", $values);

            $this->db->query($sql);
            foreach ($binds as $key => $value) {
                $this->db->bind($key, $value);
            }
            $this->db->execute();

            return true;
        } catch (Exception $e) {
            $_SESSION['message'] = 'Terjadi kesalahan saat memperbarui kategori: ' . $e->getMessage();
            $_SESSION['message_type'] = 'error';
            return false;
        }
    }




    public function deleteBlog($id_blog)
    {
        try {
            // Delete related categories
            $this->db->query("DELETE FROM blog_kategori WHERE id_blog = :id_blog");
            $this->db->bind(':id_blog', $id_blog);
            $this->db->execute();

            // Delete blog itself
            $this->db->query("DELETE FROM blogs WHERE id_blog = :id_blog");
            $this->db->bind(':id_blog', $id_blog);
            $this->db->execute();

            // Set success message
            $_SESSION['message'] = 'Blog berhasil dihapus!';
            $_SESSION['message_type'] = 'success';
            return true;
        } catch (Exception $e) {
            // Set error message
            $_SESSION['message'] = 'Gagal menghapus blog: ' . $e->getMessage();
            $_SESSION['message_type'] = 'error';
            return false;
        }
    }



    // Fungsi untuk mendapatkan id_blog terakhir dari database
    private function getLastBlogId()
    {
        $this->db->query("SELECT id_blog FROM blogs ORDER BY time_stamp DESC LIMIT 1");
        $last_id = $this->db->single();
        $last_id = $last_id['id_blog']; // Mengambil nilai id_blog dari hasil query
        return (int) str_replace('b', '', $last_id);
    }

    public function blogSelect($idBlog)
    {
        // Mengambil detail blog beserta informasi penulis
        $this->db->query('
        SELECT b.id_blog, b.judul, b.foto_blogs, b.body, b.time_stamp, m.nama_a 
        FROM blogs b 
        JOIN members m ON b.id_author = m.id 
        WHERE b.id_blog = :id
    ');
        $this->db->bind(':id', $idBlog);
        $blog = $this->db->single();

        if ($blog) {
            // Mengambil kategori yang terkait dengan blog
            $blog['kategories'] = $this->getCategoriesByBlogId($blog['id_blog']);
        }

        return $blog;
    }


    // Menggunakan Call Stored Prosedur Untuk Memanggil Data Blog Terbaru
    public function getLatestBlogs()
    {
        $this->db->query("CALL GetLatestBlogs()");
        return $this->db->resultSet();
    }
    // Menggunakan Select Function Prosedur Untuk Memanggil Author dengan Blog Terbanyak
    public function getAuthorMostBlogs()
    {
        $this->db->query("SELECT GetAuthorWithMostBlogs() AS AuthorBio ");
        $result = $this->db->single();
        return $result['AuthorBio'];
    }
}
