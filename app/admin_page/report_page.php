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
            <div class="row g-3 mb-auto">
                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Katalog</h5>
                        <p class="card-text"></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>300</strong> Koleksi</li>
                        <li class="list-group-item"><strong>3000</strong> 100 Koleksi Karya Umum</li>
                        <li class="list-group-item"><strong>3000</strong> 200 Koleksi Kementerian Pertanian</li>
                    </ul>
                    <div class="card-body">
                        <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/admin_page/detail_page.php" class="card-link link-light btn bg-primary">Detail Data</a>
                        <a href="#" class="card-link btn link-light bg-primary">
                            <svg class="me-1" width="20" height="20">
                                <use xlink:href="#print" />
                            </svg>
                            Cetak Laporan
                        </a>
                    </div>
                </div>

                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Buku Koleksi Terbaru Bulan ini</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>10</strong> Pengunjung Hari ini</li>
                        <li class="list-group-item"><strong>30</strong> Pengunjung Minggu ini</li>
                        <li class="list-group-item"><strong>90</strong> Pengunjung Bulan ini</li>
                    </ul>
                    <div class="card-body">
                        <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/admin_page/detail_page2.php" class="card-link link-light btn bg-primary">Detail Data</a>
                        <!-- <a href="#" class="card-link btn link-light bg-primary">
                            <svg class="me-1" width="20" height="20">
                                <use xlink:href="#print" />
                            </svg>
                            Cetak Laporan
                        </a> -->
                    </div>
                </div>

                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Buku Terbitan Kementan</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>100</strong> Pengunjung Hari ini</li>
                        <li class="list-group-item"><strong>230</strong> Pengunjung Minggu ini</li>
                        <li class="list-group-item"><strong>700</strong> Pengunjung Bulan ini</li>
                    </ul>
                    <div class="card-body">
                        <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/admin_page/detail_page3.php" class="card-link link-light btn bg-primary">Detail Data</a>
                        <!-- <a href="#" class="card-link btn link-light bg-primary">
                            <svg class="me-1" width="20" height="20">
                                <use xlink:href="#print" />
                            </svg>
                            Cetak Laporan
                        </a> -->
                    </div>
                </div>

                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Buku Per Kategori</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>94</strong> Pengunjung Hari ini</li>
                        <li class="list-group-item"><strong>144</strong> Pengunjung Minggu ini</li>
                        <li class="list-group-item"><strong>230</strong> Pengunjung Bulan ini</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link link-light btn bg-primary">Detail Data</a>
                        <a href="#" class="card-link btn link-light bg-primary">
                            <svg class="me-1" width="20" height="20">
                                <use xlink:href="#print" />
                            </svg>
                            Cetak Laporan
                        </a>
                    </div>
                </div>

                <div class="card me-2" style="width: 23rem;">
                    <div class="card-body">
                        <h5 class="card-title">Laporan Admin</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>100</strong> Dibaca di BPTP</li>
                        <li class="list-group-item"><strong>700</strong> Dibaca di Website</li>
                        <li class="list-group-item"><strong>500</strong> Dibaca di Android</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link link-light btn bg-primary">Detail Data</a>
                        <a href="#" class="card-link btn link-light bg-primary">
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