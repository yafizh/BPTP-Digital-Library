let reading_book_push;
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

if (!getCookie('website_guest_ip_public')) {
    setCookie('website_guest_ip_public', '192.168.1.1', 1)
    const today = new Date();
    const date_time = (
        today.getFullYear()
        + '-' +
        (today.getMonth() + 1)
        + '-' +
        today.getDate()
        + " " +
        today.getHours()
        + ":" +
        today.getMinutes()
        + ":" +
        today.getSeconds()
    );
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/?request=postWebsiteGuest`,
        type: 'POST',
        data: {
            'website_guest_ip_public': getCookie('website_guest_ip_public'),
            'website_guest_date_time_enter': date_time
        },
        dataType: 'json',
        success: function (response) {
            console.log(response)
            if(response.isSuccess) {
                setCookie('website_guest_id', response.data.website_guest_id, 1)
            }
        },
    });
}

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
                url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/index.php?request=deleteBookByBookId`,
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

$("#exampleModal").on('hidden.bs.modal', function () {
    clearTimeout(reading_book_push);
});
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
        const book = $('<div class="col-auto collection"></div>');
        book.html(
            `
                    ${sessionStorage.getItem(cacheKey) ? admin_overplay : user_overplay}
                    <div class="card p-0 shadow-sm" style="width: 12rem; height: 25rem;">
                        <img alt="Gambar Tidak Tersedia" style="height:280px; object-fit:cover;" src="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}${IMAGE_COVER_RESOURCE}${value.book_cover_uri}">
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
                                    <img src="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}${IMAGE_COVER_RESOURCE}${value.book_cover_uri}" style="max-height: 300px;">
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
                                        <div class="col">${value.book_isbn}</div>
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
                                        <div class="col">${capitalizeTheFirstLetterOfEachWord(value.book_category)}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Bahasa</div>
                                        <div class="col">${capitalizeTheFirstLetterOfEachWord(value.book_language)}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">Lokasi</div>
                                        <div class="col">Rak ${value.book_classification_number}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 170px;">File Digital</div>
                                        <div class="col">
                                            ${value.book_file_uri == null ? "File digital tidak tersedia" : `<a href="#" onclick="reading_book('${value.book_id}','${value.book_file_uri}');">Klik disini</a>`}
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
const reading_book = (book_id, book_file_uri) => {
    reading_book_push = setTimeout(function () {
        if (getCookie('website_guest_ip_public')) {
            const today = new Date();
            const date_time = (
                today.getFullYear()
                + '-' +
                (today.getMonth() + 1)
                + '-' +
                today.getDate()
                + " " +
                today.getHours()
                + ":" +
                today.getMinutes()
                + ":" +
                today.getSeconds()
            );
            $.ajax({
                url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/?request=postWebsiteBookViews`,
                type: 'POST',
                data: {
                    "book_id": book_id,
                    "website_guest_id": getCookie('website_guest_id'),
                    "website_book_views_date_time_reading": date_time
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response)
                },
            });
        }
    }, 60000); // 1 Minute
    window.open(`${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/${FILE_RESOURCE}${book_file_uri}`, '_blank', 'fullscreen=yes'); return false;
}

const searchBook = keyword => {
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/index.php?request=getBookByTitleAuthorISBNPublisher`,
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
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/index.php?request=getBookByBookId`,
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
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/index.php?request=getAllCategories`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log(data)
            showCategories(data);
        },
        error: function (data) {
            console.log(data)
        },
    });
}


const getBookByCategoryId = categoryId => {
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/index.php?request=getBookByCategoryId`,
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
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/database/index.php?request=getAllBooks`,
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
    $('#top-to-banner').append(`<a href="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/admin_page/beranda.php" class="text-white text-decoration-none ms-5">Halaman Admin</a>`)
} else {
    $('#top-to-banner').append(`<a href="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}app/admin_page/login_page.php" class="text-white text-decoration-none ms-5">Login</a>`)
}