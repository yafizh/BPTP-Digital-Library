const deleteBook = book_id => {
    Swal.fire({
        title: 'Yakin ingin menghapus data ini?',
        icon: 'question',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
        confirmButtonColor: "#DC3545",
        reverseButtons: true,
        iconColor: "#DC3545"
    }).then((resutlt) => {
        if (resutlt.isConfirmed) {
            $.ajax({
                url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/index.php?request=deleteBookByBookId`,
                type: 'POST',
                data: {
                    "book_id": book_id
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    if (data.isSuccess) {
                        Swal.fire({
                            title: 'Berhasil menghapus data',
                            icon: 'success',
                            showConfirmButton: false
                        });
                        getAllBooks();
                    } else {
                        Swal.fire({
                            title: 'Gagal menghapus data',
                            icon: 'error',
                            showConfirmButton: false
                        });
                    }
                }
            });

        }
    });

}

$('#book-search').val('')
const showBook = callback => {
    $('#book-containerrr').html('');
    $.each(callback, function (index, value) {
        const admin_overplay =
            `
                                <div class="card img-overplay" style="width: 12rem; height: 25rem;">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center h-100">
                                            <button type="button"onclick="editBook(${value.book_id})"  class="btn btn-warning mb-2">Edit Buku</button>
                                            <button type="button" onclick="deleteBook(${value.book_id})" class="btn btn-danger mt-2">Hapus Buku</button>
                                    </div>
                                </div>
                            `;
        const user_overplay =
            `
                                <div class="card img-overplay" style="width: 12rem; height: 25rem;">
                                    <div class="card-body d-flex align-items-center h-100">
                                        <h5 class="card-title text-white text-center">Klik Untuk Melihat Detail</h5>
                                    </div>
                                </div>
                            `;
        const book = $('<div class="col collection"></div>');
        book.html(
            `
                    ${sessionStorage.getItem(cacheKey) ? admin_overplay : user_overplay}
                    <div class="card p-0 shadow-sm" style="width: 12rem; height: 25rem;">
                        <img style="height:280px; object-fit:cover;" src="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/${IMAGE_COVER_RESOURCE}${value.book_cover_uri}">
                        <div class="card-body">
                            <h5 
                                class="card-title book-title" 
                                title="${value.book_title}${(value.book_sub_title) ? (': ' + value.book_sub_title) : ''}"
                            >
                                ${value.book_title}${(value.book_sub_title) ? (': ' + value.book_sub_title) : ''}
                            </h5>
                        </div>
                    </div>
                            `);
        if (!sessionStorage.getItem(cacheKey)) {
            $(book).on('click', function () {
                $("#exampleModal .modal-body").html(`
                                <div class="d-flex justify-content-center">
                                    <img src="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/${IMAGE_COVER_RESOURCE}${value.book_cover_uri}" style="max-height: 300px;">
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex">
                                        <div style="width: 170px;">Judul</div>
                                        <div class="col">${value.book_title}${(value.book_sub_title) ? (': ' + value.book_sub_title) : ''}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Penulis/Pengarang</div>
                                        <div class="col">${value.book_author}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Nomor ISBN</div>
                                        <div class="col">${value.book_isbn_number}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Penerbit</div>
                                        <div class="col">${value.book_publisher}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Tanggal Terbit</div>
                                        <div class="col">${value.book_publish_date}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Jumlah Halaman</div>
                                        <div class="col">${value.book_page} Halaman</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Dimensi(P x L)</div>
                                        <div class="col">${value.book_height} x ${value.book_width}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Kategori</div>
                                        <div class="col">${value.book_category}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Bahasa</div>
                                        <div class="col">${value.book_language}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Lokasi</div>
                                        <div class="col">${value.book_classification_number}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">File Digital</div>
                                        <div class="col">
                                            <a href="#" onclick="window.open('${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/${FILE_RESOURCE}${value.book_file_uri}', '_blank', 'fullscreen=yes'); return false;">Klik disini</a>
                                        </div>
                                    </div>
                                </div>
                            `);
                $("#exampleModal").modal('show');
            });
        }
        $('#book-containerrr').append(book);
    });

}

const searchBook = keyword => {
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/index.php?request=getBookByTitleAuthorISBNPublisher`,
        type: 'POST',
        data: {
            'keyword': keyword
        },
        dataType: 'json',
        success: function (data) {
            if (data.isSuccess) {
                showBook(data.data);
            }
        }
    });
}

$('#book-search').on('input', function () {
    searchBook($(this).val());
});


const editBook = book_id => {
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/index.php?request=getBookByBookId`,
        type: 'POST',
        data: {
            "book_id": book_id
        },
        dataType: 'json',
        success: function (data) {
            if (data[0]) {
                sessionStorage.setItem("DATA", JSON.stringify(data[0]));
                location.replace("admin_page/edit_katalog_page.php");
            }
        }
    });
}
const getAllCategories = _ => {
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/index.php?request=getAllCategories`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            showCategories(data);
        },
    });
}


const getBookByCategoryId = categoryId => {
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/index.php?request=getBookByCategoryId`,
        type: 'POST',
        data: {
            'category_id': categoryId
        },
        dataType: 'json',
        success: function (data) {
            showBook(data);
        },
    });
}

const showCategories = categories => {
    $.each(categories, function (index, value) {
        const category = $(`<a class="p-2 link-secondary text-white" href="#">${value.book_category}</a>`);
        category.on('click', _ => {
            $("#category-title").html(value.book_category);
            getBookByCategoryId(value.book_category_id);
        });
        $('#categories-container').append(category);
    })
}
const getAllBooks = _ => {
    $("#category-title").html("Semua Koleksi");
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/index.php?request=getAllBooks`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            showBook(data);
        },
    });
}

getAllCategories()
getAllBooks();
if (sessionStorage.getItem(cacheKey)) {
    $('#top-to-banner').append(`<a href="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}information_system/app/admin_page/beranda.php" class="text-dark text-decoration-none ms-5">Halaman Admin</a>`)
} else {
    $('#top-to-banner').append(`<a href="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}information_system/app/admin_page/login_page.php" class="text-dark text-decoration-none ms-5">Login</a>`)
}