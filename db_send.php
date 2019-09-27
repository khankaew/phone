<?php
    include("db_connect.php");
    $id_pay = $_POST['IdPay'];

    $type = pathinfo(basename($_FILES['Image']['name']), PATHINFO_EXTENSION);
    $img_name = uniqid().".".$type;
    $path = "images/".$img_name;
    move_uploaded_file($_FILES['Image']['tmp_name'], $path);

    $sql = "UPDATE pay SET pay_status=1, pay_slip='$img_name' WHERE pay_id=$id_pay";
    $connect->query($sql);

    header('Location: page_pay.php');
?>
