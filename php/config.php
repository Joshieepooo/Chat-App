<?php
    $conn = mysqli_connect("localhost", "root", "", "chat");
    if (!$conn) {
        echo "Database connection failed: " . mysqli_connect_error();
    }
?>
