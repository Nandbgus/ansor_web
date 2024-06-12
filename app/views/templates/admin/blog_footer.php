</div>
</main>
</div>
<!-- Toggle dark mode -->
<script>
    // Ambil elemen input pencarian
    const searchInput = document.getElementById('searchInput');

    // Ambil daftar blog
    const blogList = document.getElementById('blogList').querySelectorAll('.p-6');

    // Tambahkan event listener untuk input pencarian
    searchInput.addEventListener('input', function() {
        const searchText = searchInput.value.toLowerCase(); // Ambil teks pencarian dan ubah menjadi lowercase

        // Iterasi melalui setiap elemen dalam daftar blog
        blogList.forEach(blog => {
            const title = blog.querySelector('h2').innerText.toLowerCase(); // Ambil judul blog dan ubah menjadi lowercase

            // Periksa apakah judul blog mengandung teks pencarian
            if (title.includes(searchText)) {
                blog.style.display = 'block'; // Jika iya, tampilkan blog
            } else {
                blog.style.display = 'none'; // Jika tidak, sembunyikan blog
            }
        });
    });
</script>

</body>

</html>