<?php require_once "header.php"; ?>
<link rel="stylesheet" href="styles/new_collection.css">

<body class="bg-success text-white">
    <main>
        <style>
            img {
                object-fit: cover;
                height: 270px;
            }

            li {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            body {
                font-family: 'Comic Neue', cursive;
            }

            a {
                flex: 1;
            }
        </style>
        <section class="pt-5 text-center container">
            <div class="row py-lg-2">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-normal">KOLEKSI TERBARU PERPUSTAKAAN</h1>
                    <div class="d-flex gap-3 mt-3">
                        <a href="index.php" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Halaman Utama</a>
                        <a href="guest_form.php" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Buku Tamu</a>
                    </div>
                    <!-- <div class="input-group-lg py-3">
                        <input type="text" class="w-100 form-control" placeholder="Cari Koleksi...">
                    </div> -->
                    <hr>
                </div>
            </div>
        </section>

        <div class="album py-2">
            <div class="ps-5 pe-5 row" id="collection-container">
                <div class="col">
                    <h4 class="fw-normal text-center">KARYA UMUM</h4>
                    <hr>
                    <div id="karya-umum">

                    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="const/config.js"></script>
    <script src="scripts/new_collection.js"></script>
</body>

</html>