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

    <?php require_once "../../assets/icon_source.php" ?>

    <script src="../utils/helper.js"></script>

    <!-- CONFIG -->
    <script src="<?= '../../../CONFIGURATION.js' ?>"></script>
    <?php require_once "../../../CONFIGURATION.php"; ?>

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

    <link rel="stylesheet" href="../styles/home_page.css">
    <link rel="stylesheet" href="../styles/scrollbar-and-screen.css">
</head>

<body>
    <div class="w-100 bg-white">
        <div class="container d-flex justify-content-end p-1" id="top-to-banner">
            <a href="#" class="link-dark text-decoration-none ms-5">Versi Mobile</a>
            <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/report_page.php" class="link-dark text-decoration-none ms-5">Halaman Admin</a>
        </div>
    </div>

    <!-- Banner -->
    <div class="bg-success mb-5" style="border-bottom: 4px solid yellow;">
        <header class="container blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-6 col-md-6 pt-1 d-flex">
                    <img src="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>web_service/assets/img/logo.png" id="img-banner">
                    <div class="ms-4 mt-1 text-white">
                        <h4>PERPUSTAKAAN BPTP</h4>
                        <h4>KALIMANTAN SELATAN</h4>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <main class="container">
        <div class="d-flex">
            <div class="flex-grow-1">
                <h2 id="category-title">Laporan Pengunjung</h2>
            </div>
            <!-- <div class="flex-grow-1 align-self-center d-flex justify-content-end">
                <button type="button" style="height: fill-content;" class="btn btn-primary">
                    <svg width="20" height="20">
                        <use xlink:href="#print" />
                    </svg>
                    <label class="ms-1" for="">Cetak</label>
                </button>
            </div> -->
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
                </tbody>
            </table>
        </div>
    </main>

    <?php require_once '../utils/simple_modal.html' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
    <script>
        $.ajax({
            url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/?request=postCustomQuery`,
            type: 'POST',
            data: {
                'query': `
                    SELECT
                        guest_table.guest_full_name,
                        DATE(guest_table.guest_come_date_time) AS guest_come_date_time,
                        guest_table.guest_profession,
                        book_category_table.* 
                    FROM guest_table INNER JOIN book_category_table ON guest_table.book_category_id=book_category_table.book_category_id
                `
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                console.log(response)
                if (response.isSuccess) {
                    let nomor = 1;
                    $.each(response.data, function(index, value) {
                        $('tbody').append(`
                        <tr>
                            <th scope="row" class="text-center">${nomor}</th>
                            <td><label class="ms-1">${value.guest_full_name}</label></td>
                            <td><label class="ms-1">${dateToIndonesiaDateFormat(value.guest_come_date_time)}</label></td>
                            <td><label class="ms-1">${capitalizeTheFirstLetterOfEachWord(JSON.parse(value.guest_profession)['guest-profession'])}</label></td>
                            <td><label class="ms-1">${capitalizeTheFirstLetterOfEachWord(value.book_category)}</label></td>
                        </tr>                        
                        `)
                        nomor++;
                    })
                }
            },
        });
    </script>
</body>

</html>