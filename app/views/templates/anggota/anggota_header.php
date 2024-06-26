<!DOCTYPE html>
<html class="h-full" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['head'] ?></title>
    <link rel="stylesheet" href="/ansor/public/css/output.css">
    <link href="/ansor/public/css/datatables.min.css" rel="stylesheet">
    <script src="/ansor/public/js/alphine.js" defer></script>
    <script src="https://unpkg.com/@alpinejs/ui@3.x.x/dist/cdn.min.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="/ansor/public/js/datatables.min.js"></script>

    <style>
        @media print {
            @page {
                margin: 0;
                /* Remove default margin */
            }

            body {
                visibility: hidden;
                margin: 0;
                /* Remove default margin */
                background-color: white !important;
            }

            .printable {
                visibility: visible;
                top: 0;
                margin: 0;
                padding: 0;
                box-shadow: none;
                border: none;
            }

            .kegiatan {
                box-shadow: none;
            }

            .no-print {
                display: none;
                /* Hide elements with this class */
            }

            .printable {
                width: 100%;
                max-width: 100%;
            }

            .divide-y> :not([hidden])~ :not([hidden]) {
                --tw-divide-y-reverse: 0;
                border-top-width: calc(1px * calc(1 - var(--tw-divide-y-reverse)));
                border-bottom-width: calc(1px * var(--tw-divide-y-reverse));
            }

            .success-toast {
                background-color: #38a169 !important;
                /* TailwindCSS green-600 */
                color: white;
            }

            .error-toast {
                background-color: #e53e3e !important;
                /* TailwindCSS red-600 */
                color: white;
            }

            .hidden {
                display: none;
            }

            .modal {
                z-index: 50;
                animation: fadeIn 0.5s;
            }

            .modal-content {
                position: relative;
                animation: slideIn 0.5s;
            }
        }
    </style>
</head>

<body class="h-full" x-data="{ darkMode: false, sidebarOpen: false, toggleDarkMode() { this.darkMode = !this.darkMode } }" :class="{ 'dark': darkMode }">

    <div class="flex h-full w-full overflow-auto">
        <?php if (isset($_SESSION['message'])) : ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        position: "top-end",
                        icon: "<?= $_SESSION['message_type'] ?>",
                        title: "<?= $_SESSION['message_type'] == 'success' ? 'Berhasil' : 'Gagal' ?>",
                        text: "<?= $_SESSION['message'] ?>",
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true,
                        customClass: {
                            popup: "<?= $_SESSION['message_type'] == 'success' ? 'success-toast' : 'error-toast' ?>"
                        }
                    });
                });
            </script>
            <?php
            // Unset the message after displaying it
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            ?>
        <?php endif; ?>