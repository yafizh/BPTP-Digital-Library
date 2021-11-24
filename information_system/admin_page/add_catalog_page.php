<?php require_once 'header.php' ?>
<?php require_once "../assets/icon_source.php" ?>

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
                <li class="nav-item">
                    <a href="<?= DEVELOPMENT_BASE_URL ?>admin_page/beranda.php" class="nav-link link-dark" aria-current="page" id="beranda">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="<?= DEVELOPMENT_BASE_URL ?>admin_page/add_catalog_page.php" class="nav-link active" id="katalog">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid" />
                        </svg>
                        Katalog
                    </a>
                </li>
                <li>
                    <a href="<?= DEVELOPMENT_BASE_URL ?>admin_page/report_page.php" class="nav-link link-dark" id="reporty">
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
                <span class="fs-4">Katalog</span>
            </a>
            <hr>
            <form class="row g-3 mb-auto" id="catalog-form">


            </form>
        </div>
    </main>
    <script>
        let formData = new FormData();
        const book_cover_image = "book-cover-img";
        const book_digital_file = "book-digital-file";

        const putToForm = _ => {
            for (let value of $('form#catalog-form').serializeArray().values()) {
                formData.set(value.name, value.value);
            }
        }
        const next = current_position => {
            putToForm();
            $('form#catalog-form').html(input_form[current_position + 1]);
        }

        const prev = current_position => {
            $('form#catalog-form').html(input_form[current_position - 1]);
        }

        const save = _ => {
            putToForm();
            formData.set(book_cover_image, $(`#${book_cover_image}`).prop('files')[0]);
            formData.set(book_digital_file, $(`#${book_digital_file}`).prop('files')[0]);
            $.ajax({
                url: `${BASE_URL}index.php?request=postBook`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.isSuccess) {
                        Swal.fire({
                            title: 'Berhasil Menambahkan Data',
                            icon: 'success'
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal Menambahkan Data',
                            icon: 'error'
                        });
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
        const input_form = [
            `
                <div class="col-md-6">
                    <label for="book-title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="book-title" name="book-title" autocomplete="off">
                </div>
                <div class="col-md-6">
                    <label for="book-sub-title" class="form-label">Sub Judul</label>
                    <input type="text" class="form-control" id="book-sub-title" name="book-sub-title" autocomplete="off">
                </div>
                <div class="col-md-6">
                    <label for="book-author" class="form-label">Penulis/Pengarang</label>
                    <input type="text" class="form-control" id="book-author" name="book-author">
                </div>
                <div class="col-md-6">
                    <label for="book-language-id" class="form-label">Bahasa</label>
                    <select id="book-language-id" class="form-select" name="book-language-id">
                        <option value="1" selected>Indonesia</option>
                        <option value="2">Inggris</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="book-classification-number" class="form-label">Nomor Klasifikasi</label>
                    <input type="text" class="form-control" id="book-classification-number" name="book-classification-number">
                </div>
                <div class="col-md-6">
                    <label for="book-page" class="form-label">Jumlah Halaman</label>
                    <input type="number" class="form-control" id="book-page" name="book-page" min="0">
                </div>
                <div class="col-md-6">
                    <label for="book-stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="book-stock" name="book-stock" min="0">
                </div>
                <div class="col-md-3">
                    <label for="book-height" class="form-label">Panjang</label>
                    <input type="text" class="form-control" id="book-height" name="book-height">
                </div>
                <div class="col-md-3">
                    <label for="book-width" class="form-label">Lebar</label>
                    <input type="text" class="form-control" id="book-width" name="book-width">
                </div>
                <div class="col-md-6">
                    <label for="book-category-id" class="form-label">Kategori</label>
                    <select id="book-category-id" class="form-select" name="book-category-id">
                        <option value="1" selected>Umum</option>
                        <option value="2">Filsafat</option>
                        <option value="3">Ilmu Pengetahuan Masyarakat</option>
                        <option value="4">Bahasa</option>
                        <option value="5">Matematika</option>
                        <option value="6 PENGETAHUAN TERAPAN">Ilmu Pengetahuan Terapan</option>
                        <option value="7">Kesenian</option>
                        <option value="8">Literatur</option>
                        <option value="10">Sejarah, Biografi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="book-illustration" class="form-label">Ilustrasi</label>
                    <select id="book-illustration" class="form-select" name="book-illustration">
                        <option value="1" selected>Berilustrasi</option>
                        <option value="0">Tidak Berilustrasi</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="book-description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="book-description" rows="3" name="book-description"></textarea>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" onclick="next(0)">Selanjutnya</button>
                </div>
            `,
            `
                <div class="col-12">
                    <label for="book-isbn-number" class="form-label">Nomor ISBN</label>
                    <input type="text" class="form-control" id="book-isbn-number" name="book-isbn-number">
                </div>
                <div class="col-12">
                    <label for="book-publisher" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="book-publisher" name="book-publisher">
                </div>
                <div class="col-12">
                    <label for="book-publish-place" class="form-label">Tempat Terbit</label>
                    <input type="text" class="form-control" id="book-publish-place" name="book-publish-place">
                </div>
                <div class="col-12">
                    <label for="book-publish-date" class="form-label">Koleksi</label>
                    <div>
                        <input type="radio" class="btn-check" value="0" name="book-collection" id="old-collection" autocomplete="off" checked>
                        <label class="btn btn-outline-success" for="old-collection">Koleksi Lama</label>
                    
                        <input type="radio" class="btn-check" value="2" name="book-collection" id="new-publish" autocomplete="off">
                        <label class="btn btn-outline-success" for="new-publish">Terbitan Terbaru BPTP</label>

                        <input type="radio" class="btn-check" value="1" name="book-collection" id="new-collection" autocomplete="off">
                        <label class="btn btn-outline-success" for="new-collection">Koleksi Terbaru BPTP</label>
                    </div>
                </div>
                <div class="col-12">
                    <label for="book-publish-date" class="form-label">Tanggal Terbit</label>
                    <input type="date" class="form-control" id="book-publish-date" name="book-publish-date">
                </div>
                <div class="col-12 d-flex mt-5">
                    <div class="d-flex flex-grow-1 justify-content-start">
                        <button type="button" class="btn btn-primary" onclick="prev(1)">Sebelumnya</button>
                    </div>
                    <div class="d-flex flex-grow-1 justify-content-end">
                        <button type="button" class="btn btn-primary" onclick="next(1)">Selanjutnya</button>
                    </div>
                </div>
            `,
            `
                <div class="col-12">
                    <label for="${book_cover_image}" class="form-label">Unggah Cover</label>
                    <input type="file" accept=".png, .jpg, .jpeg" name="${book_cover_image}" class="form-control" id="${book_cover_image}">
                </div>
                <div class="col-12">
                    <label for="${book_digital_file}" class="form-label">Unggah File Digital</label>
                    <input type="file" name="${book_digital_file}" class="form-control" id="${book_digital_file}" accept=".pdf">
                </div>
                <div class="col-12 d-flex">
                    <div class="d-flex flex-grow-1 justify-content-start">
                        <button type="button" class="btn btn-primary" onclick="prev(2)">Sebelumnya</button>
                    </div>
                    <div class="d-flex flex-grow-1 justify-content-end">
                        <button type="button" class="btn btn-success" onclick="save()">Simpan</button>
                    </div>
                </div>
            `
        ];
        $('#catalog-form').html(input_form[0]);
    </script>
</body>