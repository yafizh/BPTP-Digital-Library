<?php include 'Connection.php';
require "Request.php";

$apiService = new Request($conn);
if (isset($_GET['request'])) {
    if ($_GET['request'] == 'postAuth') {
        echo $apiService->postAuth($_POST['username'], $_POST['password']);
    } else if ($_GET['request'] == 'putPassword') {
        echo $apiService->putPassword($_POST['user-id'], $_POST['new-password']);
    } else if ($_GET['request'] == 'getAllBooks') {
        echo $apiService->getAllBooks();
    } else if ($_GET['request'] == 'postCustomQuery') {
        echo $apiService->postCustomQuery($_POST['query']);
    } else if ($_GET['request'] == 'getAllCategories') {
        echo $apiService->getAllCategories();
    } else if ($_GET['request'] == 'getAllLanguages') {
        echo $apiService->getAllLanguages();
    } else if ($_GET['request'] == 'getCountBook') {
        echo (isset($_GET['book_category_id'])) ? $apiService->getCountBook($_GET['book_category_id']) : $apiService->getCountBook();
    } else if ($_GET['request'] == 'getBookByBookId') {
        echo $apiService->getBookByBookId($_POST['book_id']);
    } else if ($_GET['request'] == 'getBookByCategoryId') {
        echo $apiService->getBookByCategoryId($_POST['category_id']);
    } else if ($_GET['request'] == 'getBookByTitleAuthorISBNPublisher') {
        echo $apiService->getBookByTitleAuthorISBNPublisher($_POST['keyword']);
    } else if ($_GET['request'] == 'getBookByTitleAuthorISBNPublisherInCategory') {
        echo $apiService->getBookByTitleAuthorISBNPublisherInCategory($_POST['keyword'], $_POST['category_id']);
    } else if ($_GET['request'] == 'getNewBookCollection') {
        echo $apiService->getNewBookCollection();
    } else if ($_GET['request'] == 'getNewBookPublish') {
        echo $apiService->getNewBookPublish();
    } else if ($_GET['request'] == 'postBook') {
        $image_uploaded = false;

        $upload_cover_image = null;

        if (isset($_FILES["book-cover-img"])) {
            $cover_image_dir = "uploads/cover/";
            $cover_image_extension = explode(".", $_FILES["book-cover-img"]["name"]);
            $cover_image_extension = end($cover_image_extension);
            $upload_cover_image = date('YmdHis') . "." . $cover_image_extension;
            if (move_uploaded_file($_FILES["book-cover-img"]["tmp_name"], '../../' . $cover_image_dir . $upload_cover_image)) $image_uploaded = true;
        } else $image_uploaded = true;

        if ($image_uploaded) {
            $book = [
                'book-category-id' => $_POST['book-category-id'],
                'book-language-id' => $_POST['book-language-id'],
                'book-title' => $_POST['book-title'],
                'book-sub-title' => $_POST['book-sub-title'],
                'book-classification-number' => $_POST['book-classification-number'],
                'book-isbn' => $_POST['book-isbn'],
                'book-publisher' => $_POST['book-publisher'],
                'book-publish-place' => $_POST['book-publish-place'],
                'book-publish-date' => $_POST['book-publish-date'],
                'book-author' => $_POST['book-author'],
                'book-illustration' => $_POST['book-illustration'],
                'book-width' => $_POST['book-width'],
                'book-height' => $_POST['book-height'],
                'book-page' => $_POST['book-page'],
                'book-stock' => $_POST['book-stock'],
                'upload-cover-image' => $upload_cover_image,
                'book-description' => $_POST['book-description'],
                'book-collection' => $_POST['book-collection']
            ];
            echo $apiService->postBook($book);
        }
    } else if ($_GET['request'] == 'putBook') {
        $image_uploaded = false;

        $upload_cover_image = null;

        if (isset($_FILES["book-cover-img"])) {
            $cover_image_dir = "uploads/cover/";
            $cover_image_extension = explode(".", $_FILES["book-cover-img"]["name"]);
            $cover_image_extension = end($cover_image_extension);
            $upload_cover_image = date('YmdHis') . "." . $cover_image_extension;
            if (move_uploaded_file($_FILES["book-cover-img"]["tmp_name"], '../../' . $cover_image_dir . $upload_cover_image)) $image_uploaded = true;
        } else $image_uploaded = true;

        if ($image_uploaded) {
            $book = [
                'book-id' => $_POST['book-id'],
                'book-category-id' => $_POST['book-category-id'],
                'book-language-id' => $_POST['book-language-id'],
                'book-title' => $_POST['book-title'],
                'book-sub-title' => $_POST['book-sub-title'],
                'book-classification-number' => $_POST['book-classification-number'],
                'book-isbn' => $_POST['book-isbn'],
                'book-publisher' => $_POST['book-publisher'],
                'book-publish-place' => $_POST['book-publish-place'],
                'book-publish-date' => $_POST['book-publish-date'],
                'book-author' => $_POST['book-author'],
                'book-illustration' => $_POST['book-illustration'],
                'book-width' => $_POST['book-width'],
                'book-height' => $_POST['book-height'],
                'book-page' => $_POST['book-page'],
                'book-stock' => $_POST['book-stock'],
                (isset($_FILES["book-cover-img"]) ? "book_cover_uri" : "") => (isset($_FILES["book-cover-img"]) ? $upload_cover_image : ""),
                'book-description' => $_POST['book-description'],
                'book-collection' => $_POST['book-collection']
            ];
            echo $apiService->putBook($book);
        }
    } else if ($_GET['request'] == 'deleteBookByBookId') {
        echo $apiService->deleteBookByBookId($_POST['book_id']);
    }
}
