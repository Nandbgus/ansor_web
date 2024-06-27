
    $('#example').DataTable({
        columnDefs: [{
                targets: [7],
                visible: false
            } // Automatically hide the first column (change the index as needed)
        ],
        layout: {
            topStart: {

                buttons: [{
                        extend: 'print',
                        text: 'Print',
                        autoPrint: true,
                        className: 'ButtonTool',
                        customize: function(win) {
                            var table = $('#example').DataTable();
                            var columnsVisible = table.columns(':visible').indexes().toArray();

                            $(win.document.body)
                                .css('font-size', '10pt')
                                .append(
                                    '<style>' +
                                    'table { border-collapse: collapse; width: 100%; }' +
                                    'th, td { border: 1px solid black; padding: 0.5em; }' +
                                    'th { background-color: #2d3748; color: white; text-align: left; }' +
                                    'tbody tr:nth-child(even) { background-color: #f8fafc; }' +
                                    'tbody tr:nth-child(odd) { background-color: #e2e8f0; }' +
                                    '</style>'
                                );

                            $(win.document.body).find('table').find('thead th').each(function(index) {
                                if (!columnsVisible.includes(index)) {
                                    $(this).css('display', 'none');
                                }
                            });

                            $(win.document.body).find('table').find('tbody td').each(function(index) {
                                var colIdx = $(this).index();
                                if (!columnsVisible.includes(colIdx)) {
                                    $(this).css('display', 'none');
                                }
                            });
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Visibility',
                        className: 'ButtonTool',
                        columns: ':not(.noVis)' // Automatically exclude columns with class 'noVis'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'ButtonTool',
                        text: 'Download PDF',
                        title: 'Daftar Anggota',
                        customize: function(doc) {
                            // Adjust table styles
                            doc.styles.tableHeader = {
                                fillColor: '#2d3748',
                                color: 'white',
                                alignment: 'left'
                            };
                            doc.styles.tableBodyEven = {
                                fillColor: '#f8fafc'
                            };
                            doc.styles.tableBodyOdd = {
                                fillColor: '#e2e8f0'
                            };

                            var table = $('#example').DataTable();
                            var visibleColumns = table.columns(':visible').indexes().toArray();


                            // Create new body array
                            var body = [];

                            // Create header row
                            var headerRow = [];
                            table.columns(':visible').every(function(index) {
                                headerRow.push({
                                    text: $(table.column(index).header()).text(),
                                    style: 'tableHeader'
                                });
                            });
                            body.push(headerRow);

                            // Create data rows
                            table.rows({
                                search: 'applied'
                            }).every(function(rowIdx) {
                                var dataRow = [];
                                visibleColumns.forEach(function(index) {
                                    dataRow.push({
                                        text: table.cell(rowIdx, index).data(),
                                        style: rowIdx % 2 === 0 ? 'tableBodyEven' : 'tableBodyOdd'
                                    });
                                });
                                body.push(dataRow);
                            });

                            // Update doc content
                            doc.content[1].table.body = body;

                            // Adjust column widths based on visible columns
                            var widths = visibleColumns.map(function(index) {
                                var columnWidth = $(table.column(index).header()).outerWidth();
                                return (columnWidth / $(table.table().container()).width() * 100) + '%';
                            });

                            doc.content[1].table.widths = widths;
                        }
                    }
                ],

            }
        },
    });

    function uploadImage() {
        document.getElementById("uploadForm").submit();
    }

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