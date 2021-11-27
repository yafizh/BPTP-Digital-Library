<?php require_once "header.php"; ?>
<body class="d-flex align-items-center justify-content-center bg-success text-white h-100">
    <main class="align-items-center w-75 d-flex flex-column">
        <img src="assets/img/logo.png" width="200">
        <h1 class="mt-3 text-center">BUKU TAMU <br> PERPUSTAKAAN BPTP KALSEL</h1>
        <div class="w-75 d-flex gap-3 mt-3">
            <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>visitor_attendance/collection_availability.php" style="flex: 1;" class="d-flex align-items-center justify-content-center btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Ketersediaan Koleksi</a>
            <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>visitor_attendance/new_collection.php" style="flex: 1;" class="d-flex align-items-center justify-content-center btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Koleksi Terbaru</a>
            <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>visitor_attendance/guest_form.php" style="flex: 1;" class="d-flex align-items-center justify-content-center btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Buku Tamu</a>
        </div>
    </main>
</body>
</html>