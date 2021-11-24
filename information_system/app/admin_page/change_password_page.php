<?php require_once 'header.php' ?>

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
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/beranda.php" class="nav-link link-dark" aria-current="page" id="beranda">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/add_catalog_page.php" class="nav-link link-dark" id="katalog">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid" />
                        </svg>
                        Katalog
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/report_page.php" class="nav-link link-dark" id="reporty">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#table" />
                        </svg>
                        Laporan
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/change_password_page.php" class="nav-link active" id="ganti_password">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Ganti Password
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/login_page.php" class="nav-link link-dark">
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
                <span class="fs-4">Ganti Password</span>
            </a>
            <hr>
            <form method="POST" class="g-3 mb-auto">
                <div class="mb-3 row">
                    <label for="old-password" class="col-sm-3 col-form-label">Password Lama</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="old-password" autocomplete="off" name="old-password">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="new-password" class="col-sm-3 col-form-label">Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="new-password" autocomplete="off" name="new-password">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="confirm-new-password" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirm-new-password" autocomplete="off" name="confirm-new-password">
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        $('form').on('submit', e => {
            e.preventDefault();

            if ($('#new-password').val() == $('#confirm-new-password').val()) {
                $.ajax({
                    url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/?request=postAuth`,
                    type: 'POST',
                    data: {
                        'username': JSON.parse(sessionStorage.getItem(cacheKey)).user_username,
                        'password': $('#old-password').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.isSuccess && ($('#new-password').val() == $('#confirm-new-password').val())) {
                            $.ajax({
                                url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/?request=putPassword`,
                                type: 'POST',
                                data: {
                                    "user-id": JSON.parse(sessionStorage.getItem(cacheKey)).user_id,
                                    "new-password": $('#new-password').val()
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.isSuccess) {
                                        Swal.fire({
                                            title: 'Berhasil Mengubah Password',
                                            icon: 'success',
                                            showConfirmButton: false
                                        }).then((result) => {
                                            if (result.isDismissed) {
                                                location.reload();
                                            }
                                        });
                                    } else {
                                        console.log(response)
                                    }
                                },
                            });
                        } else {
                            console.log(response)
                        }
                    },
                });
            } else {
                alert('password tidak sama')
            }

        })
    </script>
</body>