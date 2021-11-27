const showBook = data => {
    $('#collection-container').html('')
    let row = $("<div class='row'></div>");
    $.each(data, function(index, value) {
        const book = `
            <div class="col-6 col-sm-5 col-md-4 col-lg-3 col-xl-2 mb-4">
                <div class="card">
                    <img src="${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/${IMAGE_COVER_RESOURCE}${value.book_cover_uri}" class="card-img-top">
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
            row = $("<div class='row'></div>");
        }
    });

}

const getAllBooks = _ => {
    $.ajax({
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/?request=getAllBooks`,
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
        url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/?request=getBookByTitleAuthorISBNPublisher`,
        type: 'POST',
        data: {
            'keyword': keyword
        },
        dataType: 'json',
        success: function (response) {
            if (response.isSuccess) {
                showBook(response.data);
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