<?php
    require_once '../connect.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM adminlogin WHERE stt=$id";
    $query = mysqli_query($conn,$sql);
    header('location: admin.php');





?>