<?php date_default_timezone_set('Asia/Kuala_Lumpur');

class Request
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllBooks()
    {
        $result = $this->conn->query("SELECT * FROM book_view");
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getAllCategories()
    {
        $result = $this->conn->query("SELECT * FROM book_category_table");
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getAllLanguages()
    {
        $result = $this->conn->query("SELECT * FROM book_language_table");
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getBookByBookId($bookId)
    {
        $result = $this->conn->query("SELECT * FROM book_view WHERE book_id = " . $bookId);
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function getBookByCategoryId($categoryId)
    {
        $result = $this->conn->query("SELECT * FROM book_table WHERE book_category_id = " . $categoryId);
        return json_encode($result->fetch_all(MYSQLI_ASSOC));
    }

    public function postBook($book)
    {
        $query = "INSERT INTO book_table (
            book_category_id,
            book_language_id,
            book_title,
            book_sub_title,
            book_classification_number,
            book_isbn_number,
            book_publisher,
            book_publish_place,
            book_publish_date,
            book_author,
            book_illustration,
            book_width,
            book_height,
            book_page,
            book_stock,
            book_cover_uri,
            book_file_uri,
            book_description
        ) VALUES (
            '" . $book['book-category-id'] . "',
            '" . $book['book-language-id'] . "',
            '" . $book['book-title'] . "',
            '" . $book['book-sub-title'] . "',
            '" . $book['book-classification-number'] . "',
            '" . $book['book-isbn-number'] . "',
            '" . $book['book-publisher'] . "',
            '" . $book['book-publish-place'] . "',
            '" . $book['book-publish-date'] . "',
            '" . $book['book-author'] . "',
            '" . $book['book-illustration'] . "',
            '" . $book['book-width'] . "',
            '" . $book['book-height'] . "',
            '" . $book['book-page'] . "',
            '" . $book['book-stock'] . "',
            '" . $book['upload-cover-image'] . "',
            '" . $book['upload-file'] . "',
            '" . $book['book-description'] . "'
        )";

        if ($this->conn->query($query)) {
            if ($book['book-collection'] == "1") {
                $query = "INSERT INTO book_new_collection_table (
                    book_id,
                    book_new_collection_timestamp 
                ) VALUES (
                    '" . $this->conn->insert_id . "',
                    '" . date("Y-m-d H:i:s") . "'
                )";
                if ($this->conn->query($query)) {
                    return json_encode([
                        "isSuccess" => true,
                        "message" => ["New record created to book_table successfully", "New record created to book_new_collection_table successfully"]
                    ]);
                }
            } else if ($book['book-collection'] == "2") {
                $query = "INSERT INTO book_new_publish_table (
                    book_id,
                    book_new_publish_timestamp 
                ) VALUES (
                    '" . $this->conn->insert_id . "',
                    '" . date("Y-m-d H:i:s") . "'
                )";
                if ($this->conn->query($query)) {
                    return json_encode([
                        "isSuccess" => true,
                        "message" => ["New record created to book_table successfully", "New record created to book_new_publish_table successfully"]
                    ]);
                }
            }
            return json_encode([
                "isSuccess" => true,
                "message" => "New record created successfully"
            ]);
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }

    public function putBook($book)
    {
        $query = "UPDATE book_table SET 
            book_category_id = '" . $book['book-category-id'] . "',
            book_language_id = '" . $book['book-language-id'] . "',
            book_title = '" . $book['book-title'] . "',
            book_sub_title = '" . $book['book-sub-title'] . "',
            book_classification_number = '" . $book['book-classification-number'] . "',
            book_isbn_number = '" . $book['book-isbn-number'] . "',
            book_publisher = '" . $book['book-publisher'] . "',
            book_publish_place = '" . $book['book-publish-place'] . "',
            book_publish_date = '" . $book['book-publish-date'] . "',
            book_author = '" . $book['book-author'] . "',
            book_illustration = '" . $book['book-illustration'] . "',
            book_width = '" . $book['book-width'] . "',
            book_height = '" . $book['book-height'] . "',
            book_page = '" . $book['book-page'] . "',
            book_stock = '" . $book['book-stock'] . "',"
            . (isset($book["book_cover_uri"]) ? "book_cover_uri = '" . $book["book_cover_uri"] . "'," : "")
            . (isset($book["book_file_uri"]) ? "book_file_uri = '" . $book["book_file_uri"] . "'," : "")  .
            "book_description = '" . $book['book-description'] . "' 
            WHERE book_id = " . $book['book-id'];
        if ($this->conn->query($query)) {
            if (
                $this->conn->query("DELETE FROM book_new_collection_table WHERE book_id=" . $book['book-id']) >= 0
                &&
                $this->conn->query("DELETE FROM book_new_publish_table WHERE book_id=" . $book['book-id']) >= 0
            ) {
                if ($book['book-collection'] == "1") {
                    $query = "INSERT INTO book_new_collection_table (
                        book_id,
                        book_new_collection_timestamp 
                    ) VALUES (
                        '" . $book['book-id'] . "',
                        '" . date("Y-m-d H:i:s") . "'
                    )";
                    if ($this->conn->query($query)) {
                        return json_encode([
                            "isSuccess" => true,
                            "message" => ["New record updated to book_table successfully", "New record updated to book_new_collection_table successfully"]
                        ]);
                    }
                } else if ($book['book-collection'] == "2") {
                    $query = "INSERT INTO book_new_publish_table (
                        book_id,
                        book_new_publish_timestamp 
                    ) VALUES (
                        '" . $book['book-id'] . "',
                        '" . date("Y-m-d H:i:s") . "'
                    )";
                    if ($this->conn->query($query)) {
                        return json_encode([
                            "isSuccess" => true,
                            "message" => ["New record updated to book_table successfully", "New record updated to book_new_publish_table successfully"]
                        ]);
                    }
                }
                return json_encode([
                    "isSuccess" => true,
                    "message" => "New record updated successfully"
                ]);
            }
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }

    public function deleteBookByBookId($bookId)
    {
        $query = "DELETE FROM book_table WHERE book_id = " . $bookId;
        if ($this->conn->query($query) === TRUE) {
            return json_encode([
                "isSuccess" => true,
                "message" => "New record deleted successfully"
            ]);
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }

    public function getBookByTitleAuthorISBNPublisherd($keyword)
    {
        $query = "SELECT * FROM book_table WHERE 
                book_title LIKE '%" . $keyword . "%' 
                OR 
                book_sub_title LIKE '%" . $keyword . "%' 
                OR 
                book_isbn_number LIKE '%" . $keyword . "%' 
                OR 
                book_author LIKE '%" . $keyword . "%' 
                OR 
                book_classification_number LIKE '%" . $keyword . "%' 
                OR 
                book_publisher LIKE '%" . $keyword . "%'
        ";

        if ($result = $this->conn->query($query)) {
            return json_encode([
                "isSuccess" => true,
                "data" => $result->fetch_all(MYSQLI_ASSOC)
            ]);
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }

    public function getNewBookCollection()
    {
        if ($result = $this->conn->query("SELECT * FROM new_book_collection_view")) {
            return json_encode([
                "isSuccess" => true,
                "data" => $result->fetch_all(MYSQLI_ASSOC)
            ]);
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }

    public function getNewBookPublish()
    {
        if ($result = $this->conn->query("SELECT * FROM book_new_publish_view")) {
            return json_encode([
                "isSuccess" => true,
                "data" => $result->fetch_all(MYSQLI_ASSOC)
            ]);
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }

    public function postAuth($username, $password)
    {
        if ($result = $this->conn->query("SELECT * FROM user_table WHERE user_username='$username' AND user_password='$password'")) {
            if ($result->num_rows) {
                $user = $result->fetch_all(MYSQLI_ASSOC)[0];
                return json_encode([
                    "isSuccess" => true,
                    "message" => 'Login Successfully',
                    "data" => [
                        'user_id' => $user['user_id'],
                        'user_username' => $user['user_username']
                    ]
                ]);
            } else {
                return json_encode([
                    "isSuccess" => false,
                    "message" => 'Username atau password salah!'
                ]);
            }
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }
    public function putPassword($user_id, $new_password)
    {
        if ($this->conn->query("UPDATE user_table SET user_password='" . $new_password . "' WHERE user_id='" . $user_id . "'")) {
            return json_encode([
                "isSuccess" => true,
                "message" => 'Password Changed Successfully'
            ]);
        } else {
            return json_encode([
                "isSuccess" => false,
                "message" => $this->conn->error
            ]);
        }
    }
}
