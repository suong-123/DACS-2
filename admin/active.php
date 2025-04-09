<?php

    require_once '../connect.php';
    $id = $_GET['id'];
    $status = $_GET['status'];

    $update = "UPDATE users SET status=$status WHERE id=$id";

    mysqli_query($conn,$update);

    header('location: user.php');



?>