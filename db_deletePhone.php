<?php
    include("db_connect.php");

    $id = $_GET['Id'];

    $sql = "DELETE FROM phone WHERE ph_id=$id";
    $connect->query($sql);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
