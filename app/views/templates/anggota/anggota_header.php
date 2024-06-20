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
        }
    </style>
</head>

<body class="h-full" x-data="{ darkMode: false, sidebarOpen: false, toggleDarkMode() { this.darkMode = !this.darkMode } }" :class="{ 'dark': darkMode }">

    <div class="flex h-full w-full ">