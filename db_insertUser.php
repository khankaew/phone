<?php
    include("db_connect.php");

    $name = $_POST['Name'];
    $address = $_POST['Address'];
    $phone = $_POST['Phone'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $sql = "INSERT INTO user VALUES ('Null', '$name', '$address', '$phone', '$username', '$password', 'Null')";
    $connect->query($sql);

    header('Location: page_login.php');
?>
