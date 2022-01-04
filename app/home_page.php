<?php
    // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

?>
<?php date_default_timezone_set('Asia/Kuala_Lumpur'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan BPTP KALSEL</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.10/dist/sweetalert2.all.min.js"></script>


    <!-- CONFIG -->
    <script src="<?= '../config/CONFIGURATION.js' ?>"></script>
    <?php require_once "../config/CONFIGURATION.php"; ?>

    <script src="./utils/helper.js"></script>

    <!-- Bootstrap core CSS -->
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <!-- style blog.css -->
    <style>
        /* stylelint-disable selector-list-comma-newline-after */

        .blog-header {
            line-height: 1;
            border-bottom: 1px solid #e5e5e5;
        }

        .blog-header-logo {
            font-family: "Playfair Display", Georgia, "Times New Roman", serif;
            /*rtl:Amiri, Georgia, "Times New Roman", serif*/

            font-size: 2.25rem;
        }

        .blog-header-logo:hover {
            text-decoration: none;
        }

        body {
            font-family: 'Comic Neue', cursive;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .nav-scroller .nav-link {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .875rem;
        }

        @media (min-width: 768px) {
            .h-md-250 {
                height: 250px;
            }
        }
    </style>

    <link rel="stylesheet" href="styles/home_page.css">
    <link rel="stylesheet" href="styles/scrollbar-and-screen.css">
</head>

<body>
    <div class="w-100 bg-success">
        <div class="container d-flex justify-content-end p-1" id="top-to-banner">
            <!-- <a href="#" class="link-dark text-decoration-none ms-5">Versi Mobile</a> -->
        </div>
    </div>

    <!-- Banner -->
    <div class="bg-success mb-5" style="border-bottom: 4px solid yellow;">
        <header class="container blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-6 col-md-6 pt-1 d-flex">
                    <img src="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>assets/logo.png" id="img-banner">
                    <div class="ms-4 mt-1 text-white">
                        <h4>PERPUSTAKAAN BPTP</h4>
                        <h4>KALIMANTAN SELATAN</h4>
                    </div>
                </div>
                <div class="col-6 col-md-4 d-flex justify-content-end align-items-center">
                    <div class="w-100">
                        <label for="book-search" class="form-label text-white">Pencarian Koleksi</label>
                        <input type="text" name="book-search" id="book-search" autofocus placeholder="Cari Judul, Pengarang, Nomor ISBN, Penerbit" class="form-control">
                    </div>
                    <!-- <a class="btn btn-sm bg-white" href="login_page.php" id="login-btn">Login</a> -->
                </div>
            </div>
        </header>

        <!-- Categories -->
        <div class="nav-scroller py-1 container">
            <nav class="nav d-flex justify-content-between" id="categories-container">
                <a class="p-2 link-secondary text-white" onclick="getAllBooks()" href="#">SEMUA</a>
            </nav>
        </div>
    </div>

    <main class="container">
        <h2 class="mb-4" id="category-title">Semua Koleksi</h2>
        <div class="row g-4" id="book-containerrr"></div>
    </main>

    <?php require_once 'utils/simple_modal.html' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    <script src="scripts/home_page.js"></script>
</body>

</html>