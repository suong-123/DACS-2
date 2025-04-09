<?php
    $dsn = 'localhost';
    $user_name = 'root';
    $password = '';
    $db = 'hotel';

    $conn = mysqli_connect($dsn,$user_name,$password,$db);

    if (!$conn) {
        die("Khong thanh cong".mysqli_connect_errno());
    }
?>