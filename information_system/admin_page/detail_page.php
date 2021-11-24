<?php date_default_timezone_set('Asia/Kuala_Lumpur'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Template · Bootstrap v5.0</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">




    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
</head>

<body>
    <?php require_once "../assets/icon_source.php" ?>

    <!-- Banner -->
    <div class="bg-success mb-5" style="border-bottom: 4px solid yellow;">
        <header class="container blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1 d-flex">
                    <img src="../logo.png" width="80" alt="">
                    <div class="ms-4 mt-1 text-white">
                        <h4>PERPUSTAKAAN BPTP</h4>
                        <h4>KALIMANTAN SELATAN</h4>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <p class="text-white">Admin Version</p>
                    <!-- <a class="blog-header-logo text-dark" href="#" style="text-decoration: none;">PERPUSTAKAAN BPTP</a> -->
                </div>
                <div class="col-4 text-center">
                    <!-- <a class="blog-header-logo text-dark" href="#" style="text-decoration: none;">PERPUSTAKAAN BPTP</a> -->
                </div>
            </div>
        </header>
    </div>

    <main class="container">
        <div class="d-flex">
            <div class="flex-grow-1">
                <h2 id="category-title">Data Pengunjung</h2>
            </div>
            <div class="flex-grow-1 align-self-center d-flex justify-content-end">
                <button type="button" style="height: fill-content;" class="btn btn-primary">
                    <svg width="20" height="20">
                        <use xlink:href="#print" />
                    </svg>
                    <label class="ms-1" for="">Cetak</label>
                </button>
            </div>
        </div>
        <div class="g-4 mt-5" id="book-containerrr">
            <table class="table table-borderless table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama Pengunjung</th>
                        <th scope="col">Waktu Kunjungan</th>
                        <th scope="col">Pekerjaan/Profesi</th>
                        <th scope="col">Topik</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center" style="vertical-align: middle;">
                            <svg width="20" height="20">
                                <use xlink:href="#search" />
                            </svg>
                        </th>
                        <td scope="col">
                            <input type="text" class="form-control">
                        </td>
                        <td scope="col">
                            <input type="date" class="form-control">
                        </td>
                        <td scope="col">
                            <select class="form-select" id="guest_profession" name="guest_profession" required>
                                <option value="" selected>Pilih Pekerjaan/Profesi</option>
                                <option value="GENERAL">Umum</option>
                                <option value="STUDENT">Mahasiswa</option>
                                <option value="BPTP_EMPLOYEE">Karyawan BPTP</option>
                            </select>
                        </td>
                        <td scope="col">
                            <select id="book-category-id" class="form-select" name="book-category-id">
                                <option value="" selected>Semua</option>
                                <option value="1">Umum</option>
                                <option value="2">Filsafat</option>
                                <option value="3 PENGETAHUAN MASYARAKAT">Ilmu Pengetahuan Masyarakat</option>
                                <option value="4">Bahasa</option>
                                <option value="5">Matematika</option>
                                <option value="6 PENGETAHUAN TERAPAN">Ilmu Pengetahuan Terapan</option>
                                <option value="7">Kesenian</option>
                                <option value="8">Literatur</option>
                                <option value="10">Sejarah, Biografi</option>
                            </select>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="text-center">1</th>
                        <td><label class="ms-1">Mark</label></td>
                        <td><label class="ms-1">20 Januari 2021</label></td>
                        <td><label class="ms-1">Karyawan BPTP</label></td>
                        <td><label class="ms-1">Filsafat</label></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center">2</th>
                        <td><label class="ms-1">Jacob</label></td>
                        <td><label class="ms-1">20 Januari 202</label></td>
                        <td><label class="ms-1">Mahasiswa</label></td>
                        <td><label class="ms-1">Ilmu Pengetahuan Terapan</label></td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-center">3</th>
                        <td><label class="ms-1">Larry the Bird</label></td>
                        <td><label class="ms-1">20 Januari 202</label></td>
                        <td><label class="ms-1">Umum</label></td>
                        <td><label class="ms-1">Sejarah</label></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    <script src="const/constant_values.js"></script>
    <script src="const/config.js"></script>
</body>

</html>