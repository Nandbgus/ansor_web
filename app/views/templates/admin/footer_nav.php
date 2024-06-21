</div>
</main>
</div>
<!-- Toggle dark mode -->
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
                        extend: 'excelHtml5',
                        className: 'ButtonTool',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            var rows = $('row', sheet);

                            // Add custom header
                            var date = new Date();
                            var formattedDate = formatDate(date);
                            var title = 'Laporan - ' + formattedDate;

                            var rowCount = rows.length - 1; // Adjust for 1-based indexing and exclude header row
                            var countText = 'Jumlah Data: ' + (rowCount - 1); // Subtract header row

                            $('row:first c', sheet).attr('s', '42');
                            rows.first().before(
                                '<row r="1"><c t="inlineStr" r="A1"><is><t>' + title + ' - ' + countText + '</t></is></c></row>' +
                                '<row r="2"><c t="inlineStr" r="A2"><is><t>Date: ' + formattedDate + '</t></is></c></row>'
                            );
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'ButtonTool',
                        text: 'PDF',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(doc) {
                            var date = new Date();
                            var formattedDate = formatDate(date);
                            var title = 'Laporan';
                            doc.defaultStyle = {
                                fontSize: 10
                            };

                            var tableNode = doc.content.find(function(node) {
                                return node.table;
                            });

                            if (tableNode) {
                                tableNode.layout = {
                                    hLineWidth: function(i, node) {
                                        return 1;
                                    },
                                    vLineWidth: function(i, node) {
                                        return 1;
                                    },
                                    hLineColor: function(i, node) {
                                        return 'gray';
                                    },
                                    vLineColor: function(i, node) {
                                        return 'gray';
                                    },
                                    paddingLeft: function(i, node) {
                                        return 4;
                                    },
                                    paddingRight: function(i, node) {
                                        return 4;
                                    },
                                    paddingTop: function(i, node) {
                                        return 4;
                                    },
                                    paddingBottom: function(i, node) {
                                        return 4;
                                    }
                                };
                            }
                            // Set page size, orientation, and margins
                            doc.pageSize = 'A4';
                            doc.pageOrientation = 'landscape';
                            doc.pageMargins = [20, 20, 20, 20]; // left, top, right, bottom

                            // Access table node from document content
                            var tableNode = doc.content.find(function(node) {
                                return node.table;
                            });

                            if (tableNode) {
                                // Customize table layout
                                tableNode.layout = {
                                    hLineWidth: function(i, node) {
                                        return (i === 0 || i === node.table.body.length) ? 2 : 1;
                                    },
                                    vLineWidth: function(i, node) {
                                        return (i === 0 || i === node.table.widths.length) ? 2 : 1;
                                    },
                                    hLineColor: function(i, node) {
                                        return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';
                                    },
                                    vLineColor: function(i, node) {
                                        return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';
                                    },
                                    paddingLeft: function(i, node) {
                                        return 10;
                                    },
                                    paddingRight: function(i, node) {
                                        return 10;
                                    },
                                    paddingTop: function(i, node) {
                                        return 5;
                                    },
                                    paddingBottom: function(i, node) {
                                        return 5;
                                    }
                                };

                                // Menghitung lebar maksimal dokumen PDF
                                var pdfWidth = doc.internal.pageSize.width - 40; // dikurangi dengan margin 20 di setiap sisi

                                // Set kolom dengan persentase dari lebar dokumen
                                var colWidths = [];
                                colWidths.push(pdfWidth * 0.1); // 10% dari lebar
                                colWidths.push(pdfWidth * 0.4); // 40% dari lebar
                                colWidths.push(pdfWidth * 0.4); // 40% dari lebar
                                colWidths.push(pdfWidth * 0.1); // 10% dari lebar

                                // Manually set column widths (example)
                                tableNode.widths = ['auto', '*', '*', 'auto', '*'];
                            }

                        }
                    },
                    {
                        extend: 'print',
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

    // Initial check for selected rows
    checkSelectedRows();

    table.on('select deselect', function() {
        checkSelectedRows();
    });

    function checkSelectedRows() {
        var selectedRowsCount = table.rows({
            selected: true
        }).count();
        var viewMemberBtn = $('#viewMemberBtn');
        if (selectedRowsCount === 0) {
            viewMemberBtn.prop('disabled', true).removeClass('enabled');
        } else {
            viewMemberBtn.prop('disabled', false).addClass('enabled');
        }
    }

    $('#viewMemberBtn').on('click', function() {
        var data = table.rows({
            selected: true
        }).data();
        if (data.length > 0) {
            var idMember = data[0][1]; // Mengambil ID Member dari kolom kedua
            $('#id_member_input').val(idMember); // Set nilai input dengan id_member
            $('#memberForm').submit(); // Submit form
        } else {
            alert('Please select a member first.');
        }
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

    function viewMember(id_member) {
        document.getElementById('id_member_input').value = id_member;
        document.getElementById('memberForm').submit();
    }

    // Ambil elemen input pencarian
    const searchInput = document.getElementById('searchInput');

    // Ambil daftar blog
    const blogList = document.getElementById('blogList').querySelectorAll('.p-6');

    // Tambahkan event listener untuk input pencarian
</script>

</body>

</html>