<?php require_once 'header.php' ?>
<?php require_once "../assets/icon_source.php" ?>

<body>
    <main>
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">Admin</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="/perpustakaan/admin_page/index.php?page=0" class="nav-link link-dark" aria-current="page" id="beranda">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="<?= DEVELOPMENT_BASE_URL ?>admin_page/add_catalog_page.php" class="nav-link link-dark" id="katalog">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid" />
                        </svg>
                        Katalog
                    </a>
                </li>
                <li>
                    <a href="<?= DEVELOPMENT_BASE_URL ?>admin_page/report_page.php" class="nav-link active" id="reporty">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#table" />
                        </svg>
                        Laporan
                    </a>
                </li>
                <li>
                    <a href="<?= DEVELOPMENT_BASE_URL ?>admin_page/change_password_page.php" class="nav-link link-dark" id="ganti_password">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Ganti Password
                    </a>
                </li>
                <li>
                    <a href="<?= DEVELOPMENT_BASE_URL ?>login_page.php" class="nav-link link-dark">
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
                        <p class="card-text">Laporan jumlah seluruh katalog yang telah dimasukkan dan seluruh buku di perpustakaan BPTP kalsel.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>300</strong> Buku Online</li>
                        <li class="list-group-item"><strong>3000</strong> Koleksi Perpustakaan</li>
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
                        <h5 class="card-title">Laporan Pengunjung</h5>
                        <p class="card-text">Laporan jumlah seluruh katalog yang telah dimasukkan dan seluruh buku di perpustakaan BPTP kalsel.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>10</strong> Pengunjung Hari ini</li>
                        <li class="list-group-item"><strong>500</strong> Total Pengunjung</li>
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
                        <h5 class="card-title">Laporan Pengunjung</h5>
                        <p class="card-text">Laporan jumlah seluruh katalog yang telah dimasukkan dan seluruh buku di perpustakaan BPTP kalsel.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>10</strong> Pengunjung Hari ini</li>
                        <li class="list-group-item"><strong>500</strong> Total Pengunjung</li>
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
                        <h5 class="card-title">Laporan Pengunjung</h5>
                        <p class="card-text">Laporan jumlah seluruh katalog yang telah dimasukkan dan seluruh buku di perpustakaan BPTP kalsel.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>10</strong> Pengunjung Hari ini</li>
                        <li class="list-group-item"><strong>500</strong> Total Pengunjung</li>
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
                        <h5 class="card-title">Laporan Pengunjung</h5>
                        <p class="card-text">Laporan jumlah seluruh katalog yang telah dimasukkan dan seluruh buku di perpustakaan BPTP kalsel.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>10</strong> Pengunjung Hari ini</li>
                        <li class="list-group-item"><strong>500</strong> Total Pengunjung</li>
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