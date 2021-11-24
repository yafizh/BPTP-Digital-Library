<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $mysqli = new mysqli($servername, $username, $password,"buku_tamu");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $result = $mysqli->query("SELECT * FROM books WHERE book_name LIKE '".$_GET['keyword']."%'");

    echo json_encode($result->fetch_all(MYSQLI_ASSOC));

    $mysqli->close();
?> 