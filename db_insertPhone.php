<?php
    include("db_connect.php");

    $brane = $_POST['Brand'];
    $name = $_POST['Name'];
    $price = $_POST['Price'];
    $num = $_POST['Num'];
    $detail = $_POST['Detail'];

    $type = pathinfo(basename($_FILES['Image']['name']), PATHINFO_EXTENSION);
    $img = uniqid().".".$type;
    $path = "images/".$img;
    move_uploaded_file($_FILES['Image']['tmp_name'], $path);

    $sql = "INSERT INTO phone VALUES ('Null', '$brane', '$name', '$price', '$num', '$img', '$detail')";
    $connect->query($sql);
    header('Location: admin_phone.php');
?>
