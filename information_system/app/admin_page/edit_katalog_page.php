<?php require_once 'header.php' ?>

<main>
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap" />
            </svg>
            <span class="fs-4">Sidebar</span>
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
                <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/add_catalog_page.php" class="nav-link active" id="katalog">
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
                <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/change_password_page.php" class="nav-link link-dark" id="ganti_password">
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
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
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

    const save = (id = 0) => {
        putToForm();
        formData.set(book_cover_image, $(`#${book_cover_image}`).prop('files')[0]);
        formData.set(book_digital_file, $(`#${book_digital_file}`).prop('files')[0]);
        formData.set("book-id", editData.book_id);
        if (id == 0) {
            $.ajax({
                url: `${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/?request=putBook`,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.isSuccess) {
                        Swal.fire({
                            title: 'Berhasil mengedit data',
                            icon: 'success',
                            showConfirmButton: false
                        }).then((result) => {
                            if (result.isDismissed) {
                                location.replace("../home_page.php");
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal Mengedit Data',
                            icon: 'error',
                            showConfirmButton: false
                        });
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        } else {

        }
    }

    let editData = sessionStorage.getItem("DATA") ? sessionStorage.getItem("DATA") : "";
    if (editData) {
        editData = JSON.parse(editData);
        sessionStorage.removeItem("DATA");
    }
    const input_form = [
        `
                <div class="col-md-6">
                    <label for="book-title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="book-title" name="book-title" autocomplete="off" value="${editData.book_title}">
                </div>
                <div class="col-md-6">
                    <label for="book-sub-title" class="form-label">Sub Judul</label>
                    <input type="text" class="form-control" id="book-sub-title" name="book-sub-title" autocomplete="off" value="${editData.book_sub_title}">
                </div>
                <div class="col-md-6">
                    <label for="book-author" class="form-label">Penulis/Pengarang</label>
                    <input type="text" class="form-control" id="book-author" name="book-author" value="${editData.book_author}">
                </div>
                <div class="col-md-6">
                    <label for="book-language-id" class="form-label">Bahasa</label>
                    <select id="book-language-id" class="form-select" name="book-language-id">
                        <option ${((editData.book_language_id) == "1") ? "selected" : ""} value="1">Indonesia</option>
                        <option ${((editData.book_language_id) == "2") ? "selected" : ""} value="2">Inggris</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="book-classification-number" class="form-label">Nomor Klasifikasi</label>
                    <input type="text" class="form-control" id="book-classification-number" name="book-classification-number" value="${editData.book_classification_number}">
                </div>
                <div class="col-md-6">
                    <label for="book-page" class="form-label">Jumlah Halaman</label>
                    <input type="number" class="form-control" id="book-page" name="book-page" min="0" value="${editData.book_page}">
                </div>
                <div class="col-md-6">
                    <label for="book-stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="book-stock" name="book-stock" min="0" value="${editData.book_stock}">
                </div>
                <div class="col-md-3">
                    <label for="book-height" class="form-label">Panjang</label>
                    <input type="text" class="form-control" id="book-height" name="book-height" value="${editData.book_height}">
                </div>
                <div class="col-md-3">
                    <label for="book-width" class="form-label">Lebar</label>
                    <input type="text" class="form-control" id="book-width" name="book-width" value="${editData.book_width}">
                </div>
                <div class="col-md-6">
                    <label for="book-category-id" class="form-label">Kategori</label>
                    <select id="book-category-id" class="form-select" name="book-category-id">
                        <option ${((editData.book_category_id) == "1") ? "selected" : ""} value="1">Umum</option>
                        <option ${((editData.book_category_id) == "2") ? "selected" : ""} value="2">Filsafat</option>
                        <option ${((editData.book_category_id) == "3") ? "selected" : ""} value="3">Ilmu Pengetahuan Masyarakat</option>
                        <option ${((editData.book_category_id) == "4") ? "selected" : ""} value="4">Bahasa</option>
                        <option ${((editData.book_category_id) == "5") ? "selected" : ""} value="5">Matematika</option>
                        <option ${((editData.book_category_id) == "6") ? "selected" : ""} value="6">Ilmu Pengetahuan Terapan</option>
                        <option ${((editData.book_category_id) == "7") ? "selected" : ""} value="7">Kesenian</option>
                        <option ${((editData.book_category_id) == "8") ? "selected" : ""} value="8">Literatur</option>
                        <option ${((editData.book_category_id) == "9") ? "selected" : ""} value="9">Sejarah, Biografi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="book-illustration" class="form-label">Ilustrasi</label>
                    <select id="book-illustration" class="form-select" name="book-illustration">
                        <option ${((editData.book_illustration) == "1") ? "selected" : ""} value="1">Berilustrasi</option>
                        <option ${((editData.book_illustration) == "0") ? "selected" : ""} value="0">Tidak Berilustrasi</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="book-description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="book-description" rows="3" name="book-description">${editData.book_description}</textarea>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" onclick="next(0)">Selanjutnya</button>
                </div>
            `,
        `
                <div class="col-12">
                    <label for="book-isbn-number" class="form-label">Nomor ISBN</label>
                    <input type="text" class="form-control" id="book-isbn-number" name="book-isbn-number" value="${editData.book_isbn_number}">
                </div>
                <div class="col-12">
                    <label for="book-publisher" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="book-publisher" name="book-publisher" value="${editData.book_publisher}">
                </div>
                <div class="col-12">
                    <label for="book-publish-place" class="form-label">Tempat Terbit</label>
                    <input type="text" class="form-control" id="book-publish-place" name="book-publish-place" value="${editData.book_publish_place}">
                </div>
                <div class="col-12">
                    <label for="book-publish-date" class="form-label">Koleksi</label>
                    <div>
                        <input type="radio" class="btn-check" value="0" name="book-collection" id="old-collection" autocomplete="off" ${(!(editData.book_new_publish_id || editData.book_new_collection_id)) ? "checked" : ""}>
                        <label class="btn btn-outline-success" for="old-collection">Koleksi Lama</label>
                    
                        <input type="radio" class="btn-check" value="2" name="book-collection" id="new-publish" autocomplete="off" ${(editData.book_new_publish_id) ? "checked" : ""}>
                        <label class="btn btn-outline-success" for="new-publish">Terbitan Terbaru BPTP</label>

                        <input type="radio" class="btn-check" value="1" name="book-collection" id="new-collection" autocomplete="off" ${(editData.book_new_collection_id) ? "checked" : ""}>
                        <label class="btn btn-outline-success" for="new-collection">Koleksi Terbaru BPTP</label>
                    </div>
                </div>
                <div class="col-12">
                    <label for="book-publish-date" class="form-label">Tanggal Terbit</label>
                    <input type="date" class="form-control" id="book-publish-date" name="book-publish-date" value="${editData.book_publish_date}">
                </div>
                <div class="col-12 d-flex">
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