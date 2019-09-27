<?php
    include('db_connect.php');

    $brand = $_GET['Brand'];
    $sql = "INSERT INTO brand VALUES ('Null', '$brand')";
    $connect->query($sql);
    header('Location: admin_brand.php');
 ?>
