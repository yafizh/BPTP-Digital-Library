<?php require_once "header.php"; ?>
<link rel="stylesheet" href="styles/collection_availability.css">

<body class="bg-success text-white">
    <main>
        <section class="pt-5 text-center container">
            <div class="row py-lg-2">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-normal">KOLEKSI PERPUSTAKAAN</h1>
                    <div class="d-flex gap-3 mt-3">
                        <a style="flex: 1;" href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>visitor_attendance/" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Halaman Utama</a>
                        <a style="flex: 1;" href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>visitor_attendance/guest_form.php" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Buku Tamu</a>
                    </div>
                    <div class="input-group-lg py-3">
                        <input type="text" class="w-100 form-control" placeholder="Cari Koleksi...">
                    </div>
                    <hr>
                </div>
            </div>
        </section>
        <div class="album py-2">
            <div class="container ps-5 pe-5" id="collection-container"></div>
        </div>
    </main>
    <script src="scripts/collection_availability.js"></script>
</body>

</html>