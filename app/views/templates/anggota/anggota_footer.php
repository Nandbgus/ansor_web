</div>
</main>
</div>

<script src="https://cdn.jsdelivr.net/npm/print-js@1.6.0/dist/print.min.js"></script>
<script>
    // Fungsi untuk menambahkan kategori
    function addCategory() {
        var selectElement = document.getElementById('kategori');
        var selectedOption = selectElement.options[selectElement.selectedIndex];

        if (selectedOption && selectedOption.value) {
            var selectedCategoriesDiv = document.getElementById('selectedCategories');

            // Check if category is already selected
            var existingCategory = selectedCategoriesDiv.querySelector('[data-id="' + selectedOption.value + '"]');
            if (!existingCategory) {
                var categoryDiv = document.createElement('div');
                categoryDiv.classList.add('selected-category', 'bg-gray-200', 'rounded-md', 'px-2', 'py-1', 'inline-flex', 'items-center', 'space-x-2');
                categoryDiv.setAttribute('data-id', selectedOption.value);

                var categoryNameSpan = document.createElement('span');
                categoryNameSpan.textContent = selectedOption.text;
                categoryDiv.appendChild(categoryNameSpan);

                var removeButton = document.createElement('button');
                removeButton.setAttribute('type', 'button');
                removeButton.classList.add('text-red-500', 'hover:text-red-700');
                removeButton.textContent = 'X';
                removeButton.addEventListener('click', function() {
                    removeCategory(this);
                });
                categoryDiv.appendChild(removeButton);

                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'kategori[]');
                hiddenInput.setAttribute('value', selectedOption.value);
                categoryDiv.appendChild(hiddenInput);

                selectedCategoriesDiv.appendChild(categoryDiv);
            }
        }
    }


    // Fungsi untuk menghapus kategori
    function removeCategory(button) {
        var categoryDiv = button.closest('.selected-category');
        if (categoryDiv) {
            categoryDiv.remove();
        }
    }


    // Fungsi untuk membuka modal preview gambar
    function openModal(src) {
        var modal = document.getElementById('modalPreview');
        var modalImage = document.getElementById('modalImage');
        modalImage.src = src;
        modal.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal preview gambar
    document.getElementById('closeModal').onclick = function() {
        document.getElementById('modalPreview').classList.add('hidden');
    };

    // Fungsi untuk menutup modal jika area di luar gambar diklik
    document.getElementById('modalPreview').onclick = function(event) {
        if (event.target === this) {
            this.classList.add('hidden');
        }
    };

    // Tambahkan event listener untuk gambar saat ini
    document.getElementById('currentFoto').onclick = function() {
        openModal(this.src);
    };

    function printElement() {
        printJS({
            printable: 'elementToPrint',
            type: 'html',
            css: 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css'
        });
    }


    function uploadImage() {
        document.getElementById("uploadForm").submit();
    }

    var table = $('#example').DataTable({

        select: {
            style: 'os',
        },
        responsive: {
            details: false
        },

        layout: {
            topStart: {

                buttons: [{
                        extend: 'colvis',
                        text: 'Visibility',
                        className: 'ButtonTool',
                    },
                    {
                        extend: ['searchPanes'],
                        text: 'Filter Data',
                        className: 'ButtonTool',
                        config: {
                            threshold: 0.8,
                        }
                    }
                ],
            }
        },

    });

    // Add click event listener to table rows
    $('#example tbody').on('click', 'tr', function() {
        var id_member = $(this).data('id');
        var nama = $(this).data('nama');
        var noHp = $(this).data('no-hp');
        var desa = $(this).data('desa');
        var status = $(this).data('status');

        $('#id-member').val(id_member);
        $('#member-nama').text(nama);
        $('#member-noHp').text(noHp);
        $('#member-desa').text(desa);
        $('#member-status').text(status);

        $('#member-details').show();
    });

    // Menangkap elemen select dusun
    var selectDusun = document.querySelector('select[name="id_dusun"]');
    var lastIdAnggota = '<?= $data['lastIdAnggota']["id"] ?? "XII265DEFAULT0" ?>'; // ID anggota terakhir atau default
    // Mendapatkan input ID anggota
    var idAnggotaInput = document.querySelector('input[name="id"]');
    // Menambahkan event listener untuk memantau perubahan pada select dusun
    selectDusun.addEventListener('change', function() {
        // Mendapatkan nama desa dari atribut data-nama-desa
        var namaDesa = selectDusun.options[selectDusun.selectedIndex].getAttribute('data-nama-desa');

        // Mendapatkan nomor terakhir dari ID anggota yang sudah ada atau tetapkan nilai default 0 jika tidak ada
        var existingId = lastIdAnggota || 'XII265' + namaDesa.replace(/\s+/g, '').toUpperCase() + '0';
        var lastNumber = 0;
        if (existingId) {
            var matches = existingId.match(/\d+$/);
            if (matches) {
                lastNumber = parseInt(matches[0]); // Mengambil angka di akhir ID anggota
            }
        }

        // Menghitung nomor berikutnya
        var nextNumber = lastNumber + 1;
        // Membuat ID anggota berdasarkan kriteria XII265$nama_desa1
        var idAnggota = 'XII265' + namaDesa.replace(/\s+/g, '').toUpperCase() + nextNumber;

        // Mengisi nilai input ID anggota dengan ID yang dibuat
        idAnggotaInput.value = idAnggota;
    });

    function formatDate(date) {
        const monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        const day = date.getDate();
        const monthIndex = date.getMonth();
        const year = date.getFullYear();
        return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }
</script>

</body>

</html>