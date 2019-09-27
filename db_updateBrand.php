<?php
    include("db_connect.php");

    $id = $_GET['Id'];
    $brand = $_GET['Brand'];
    $sql = "UPDATE brand SET br_name='$brand' WHERE br_id='$id'";
    $connect->query($sql);
    header('Location: admin_brand.php');
?>
