<?php

   require_once '../connect.php';

$id = $_GET['id'];
$check = $_GET['check'];

// Use backticks around the column name CHECK
$update = "UPDATE danhgia SET `check` = $check WHERE id_danhgia = $id";

mysqli_query($conn, $update);

header('location: index.php');




?>