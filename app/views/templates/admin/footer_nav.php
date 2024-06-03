</div>
</main>
</div>
<!-- Toggle dark mode -->
<script>
    $('#example').DataTable({

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
                            doc.pageSize = 'A4';
                            doc.pageMargins = [20, 20, 20, 20]; // left, top, right, bottom
                            doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');


                            // Add date above the table
                            doc.content.splice(1, 0, {
                                text: 'Date: ' + formattedDate,
                                alignment: 'center',
                                margin: [0, 0, 0, 10]
                            });

                            // Adjust the table layout only if it exists
                            if (doc.content.length > 2 && doc.content[2].table) {
                                var table = doc.content[2].table;
                                table.widths = Array(table.body[0].length + 1).join('*').split('');
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