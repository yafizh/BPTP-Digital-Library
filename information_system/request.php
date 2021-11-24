<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$mysqli = new mysqli($servername, $username, $password, "si_perpustakaan");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['login'])) {
    $query = "SELECT * FROM users WHERE 
                username='" . $mysqli->real_escape_string($_POST['username']) . "' 
                AND 
                password='" . $mysqli->real_escape_string($_POST['password']) . "'";
    $result = $mysqli->query($query);
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
} else if (isset($_POST['book_data'])) {
    if ($_GET['keyword'] == 'SEMUA') $result = $mysqli->query("SELECT * FROM books");
    else $result = $mysqli->query("SELECT * FROM books WHERE book_category='" . $_GET['keyword'] . "'");
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
} else if (isset($_POST['search_book'])) {
    $query = "SELECT * FROM books WHERE 
                book_title LIKE '%" . $_POST['keyword'] . "%' 
                OR 
                book_sub_title LIKE '%" . $_POST['keyword'] . "%' 
                OR 
                book_isbn_number LIKE '%" . $_POST['keyword'] . "%' 
                OR 
                book_author LIKE '%" . $_POST['keyword'] . "%' 
                OR 
                book_classification_number LIKE '%" . $_POST['keyword'] . "%' 
                OR 
                book_publisher LIKE '%" . $_POST['keyword'] . "%'

    ";
    $result = $mysqli->query($query);

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
} else if (isset($_POST['search_book_by_id'])) {
    $query = "SELECT * FROM books WHERE id = " . $_POST['book_id'];
    $result = $mysqli->query($query);
    
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
}

$mysqli->close();
