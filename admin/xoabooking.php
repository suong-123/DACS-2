<?php
    require_once '../connect.php';
     $id = $_GET['id'];
    $sql = "DELETE FROM datphong WHERE id_book=$id";
    $query = mysqli_query($conn,$sql);
    header('location: booking.php');


?>