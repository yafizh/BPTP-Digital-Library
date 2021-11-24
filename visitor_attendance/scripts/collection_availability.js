const showBook = data => {
    $('#collection-container').html('')
    let row = $("<div class='row mb-4'></div>");
    $.each(data, function(index, value) {
        const book = `
            <div class="col-md-2">
                <div class="card">
                    <img src="${BASE_URL}${IMAGE_COVER_RESOURCE}${value.book_cover_uri}" class="card-img-top">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center" title="${value.book_title}">${value.book_title}</li>
                    </ul>
                    <div class="card-footer text-success text-center">
                        ${(value.book_stock > 0) ? 'Tersedia':'Tidak Tersedia'}
                    </div>
                </div>
            </div>
        `;
        $(row).append(book);

        if (index === data.length - 1)
            $('#collection-container').append(row);
        else if ((index + 1) % 6 === 0) {
            $('#collection-container').append(row);
            row = $("<div class='row mb-4'></div>");
        }
    });

}

const getAllBooks = _ => {
    $.ajax({
        url: `${BASE_URL}index.php?request=getAllBooks`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            showBook(data);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

const searchBook = keyword => {
    $.ajax({
        url: `${BASE_URL}index.php?request=getBookByTitleAuthorISBNPublisher`,
        type: 'POST',
        data: {
            'keyword': keyword
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            if (data.isSuccess) {
                showBook(data.data);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}

$(document).ready(function() {
    $('input').on('input', function() {
        searchBook($(this).val());
    });
    
    getAllBooks();
});