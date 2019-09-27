<?php
    include("db_connect.php");
    $id = $_POST['Id'];
    $brane = $_POST['Brand'];
    $name = $_POST['Name'];
    $price = $_POST['Price'];
    $num = $_POST['Num'];
    $detail = $_POST['Detail'];

    $type = pathinfo(basename($_FILES['Image']['name']), PATHINFO_EXTENSION);
    $img = uniqid().".".$type;
    $path = "images/".$img;
    move_uploaded_file($_FILES['Image']['tmp_name'], $path);

    $sql = "UPDATE phone SET ph_brand='$brane', ph_name='$name', ph_price='$price', ph_num='$num', ph_image='$img', ph_detail='$detail' WHERE ph_id='$id'";
    $connect->query($sql);
    header('Location: admin_phone.php');
?>
