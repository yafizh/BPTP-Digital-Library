const showBook = (data, container) => {
    let row = $("<div class='row mb-4'></div>");
    $.each(data, function(index, value) {
        console.log(value)
        const book = `
            <div class="col-md-4 mt-4">
                <div class="card">
                    <img src="${BASE_URL}${IMAGE_COVER_RESOURCE}${value.book_cover_uri}" class="card-img-top">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-center" title="${value.book_title}">${value.book_title}</li>
                    </ul>
                </div>
            </div>
        `;
        $(row).append(book);

        if (index === data.length - 1)
            $(container).append(row);
        else if ((index + 1) % 6 === 0) {
            $(container).append(row);
            row = $("<div class='row mb-4'></div>");
        }
    });
}
const getCollectionData = (method,container) => {
    $.ajax({
        url: `${BASE_URL}index.php?request=${method}`,
        dataType: 'json',
        async: true,
        success: function(response) {
            if(response.isSuccess) {
                showBook(response.data, container);
            }
        },
        error: function(result) {
            console.log(result);
        }
    });
}


$(document).ready(function() {
    getCollectionData("getNewBookCollection","#karya-umum");
    getCollectionData("getNewBookPublish", "#karya-bptp");
});