<?php
    require_once '../connect.php';
     $id = $_GET['id'];
    $sql = "DELETE FROM phong WHERE maphong=$id";
    $query = mysqli_query($conn,$sql);
    header('location: phong.php');





?>