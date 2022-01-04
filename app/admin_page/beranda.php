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
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>app/admin_page/report_page.php" class="nav-link link-dark" id="reporty">
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

        <div class="b-example-divider" style="position: relative; z-index:9;"></div>
    </main>