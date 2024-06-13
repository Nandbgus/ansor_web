</div>
</main>
</div>
<script>
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