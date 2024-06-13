<!DOCTYPE html>
<html lang="en">

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
</head>

<body class="h-full" x-data="{ darkMode: false, sidebarOpen: false, toggleDarkMode() { this.darkMode = !this.darkMode } }" :class="{ 'dark': darkMode }">

    <div class="flex h-full w-full">