<?php require_once 'header.php' ?>

<body>
    <main>
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-5" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">Admin</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/home_page.php" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg>
                        Halaman Utama
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/admin_page/add_catalog_page.php" class="nav-link link-dark" id="katalog">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid" />
                        </svg>
                        Katalog
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/admin_page/report_page.php" class="nav-link active" id="reporty">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#table" />
                        </svg>
                        Laporan
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/admin_page/change_password_page.php" class="nav-link link-dark" id="ganti_password">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Ganti Password
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/admin_page/login_page.php" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#logout" />
                        </svg>
                        Keluar
                    </a>
                </li>
            </ul>
        </div>

        <div class="b-example-divider"></div>

        <div class="d-flex flex-column flex-grow-1 p-3 bg-light">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <span class="fs-4">Laporan</span>
            </a>
            <hr>
            <div class="row g-3">
                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Laporan Buku Terpopuler</h5>
                        <form action="../report_page/book_by_category_report.php" target="_blank" method="POST">
                            <input type="month" value="<?= Date("Y-m"); ?>" class="form-control mt-3 mb-3">
                            <button type="submit" class="card-link btn link-light bg-primary" style="width: 250px;">
                                <svg class="me-1" width="20" height="20">
                                    <use xlink:href="#print" />
                                </svg>
                                Cetak Laporan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Laporan Buku Koleksi Terbaru</h5>
                        <form action="../report_page/book_by_category_report.php" target="_blank" method="POST">
                            <input type="month" value="<?= Date("Y-m"); ?>" class="form-control mt-3 mb-3">
                            <button type="submit" class="card-link btn link-light bg-primary" style="width: 250px;">
                                <svg class="me-1" width="20" height="20">
                                    <use xlink:href="#print" />
                                </svg>
                                Cetak Laporan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Laporan Buku Terbitan Kementan</h5>
                        <form action="../report_page/book_by_category_report.php" target="_blank" method="POST">
                            <input type="month" value="<?= Date("Y-m"); ?>" class="form-control mt-3 mb-3">
                            <button type="submit" class="card-link btn link-light bg-primary" style="width: 250px;">
                                <svg class="me-1" width="20" height="20">
                                    <use xlink:href="#print" />
                                </svg>
                                Cetak Laporan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Laporan Buku Per Kategori</h5>
                        <form action="../report_page/book_by_category_report.php" target="_blank" method="POST">
                            <select class="form-select mt-3 mb-3" name="category_id">
                                <option value="1" selected>Umum</option>
                                <option value="2">Filsafat</option>
                                <option value="3">Ilmu Pengetahuan Masyarakat</option>
                                <option value="4">Bahasa</option>
                                <option value="5">Matematika</option>
                                <option value="6">Ilmu Pengetahuan Terapan</option>
                                <option value="7">Kesenian</option>
                                <option value="8">Literatur</option>
                                <option value="10">Sejarah, Biografi</option>
                            </select>
                            <button type="submit" class="card-link btn link-light bg-primary" style="width: 250px;">
                                <svg class="me-1" width="20" height="20">
                                    <use xlink:href="#print" />
                                </svg>
                                Cetak Laporan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Laporan Admin</h5>
                        <a href="../report_page/admin_report.php" target="_blank" class=" card-link btn link-light bg-primary">
                            <svg class="me-1" width="20" height="20">
                                <use xlink:href="#print" />
                            </svg>
                            Cetak Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>