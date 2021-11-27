<?php require_once "header.php"; ?>
<link rel="stylesheet" href="styles/new_collection.css">

<body class="bg-success text-white">
    <main>
        <style>
            #collection-container img {
                object-fit: cover;
                height: 270px;
            }

            li {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
        <section class="pt-5 text-center container">
            <div class="row py-lg-2">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-normal">KOLEKSI TERBARU PERPUSTAKAAN</h1>
                    <div class="d-flex gap-3 mt-3">
                        <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>visitor_attendance/" style="flex: 1" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Halaman Utama</a>
                        <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>visitor_attendance/guest_form.php" style="flex: 1" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Buku Tamu</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="album py-5 ">
            <div class="ps-5 pe-5 row" id="collection-container">
                <div class="col">
                    <h4 class="fw-normal text-center">KARYA UMUM</h4>
                    <hr>
                    <div id="karya-umum"></div>
                </div>
                <div class="divider col-1"></div>
                <div class="col">
                    <h4 class="fw-normal text-center">KARYA TERBITAN BPTP</h4>
                    <hr>
                    <div id="karya-bptp"></div>
                </div>
            </div>
        </div>

    </main>
    <script src="scripts/new_collection.js"></script>
</body>
</html>