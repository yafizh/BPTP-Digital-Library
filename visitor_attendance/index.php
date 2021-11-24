<?php require_once "header.php"; ?>
<style>
    html,
    body {
        height: 100%;
        font-family: 'Comic Neue', cursive;
    }

    img {
        width: 200px;
    }

    a {
        flex: 1;
    }
</style>

<body class="d-flex align-items-center justify-content-center bg-success text-white">
    <main class="align-items-center w-75 d-flex flex-column">
        <img src="assets/img/logo.png">
        <h1 class="mt-3 text-center">BUKU TAMU <br> PERPUSTAKAAN BPTP KALSEL</h1>
        <div class="w-75 d-flex gap-3 mt-3">
            <a href="collection_availability.php" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Ketersediaan Koleksi</a>
            <a href="new_collection.php" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Koleksi Terbaru</a>
            <a href="guest_form.php" class="btn btn-lg btn-secondary fw-bold border-success text-success bg-white">Buku Tamu</a>
        </div>
    </main>
</body>

</html>