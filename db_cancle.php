<?php
    include("db_connect.php");
    session_start();

    $id_phone = $_GET['PhoneId'];
    $id_bag = $_GET['BagId'];

    $sql = "SELECT * FROM phone WHERE ph_id=$id_phone";
    $result = mysqli_query($connect, $sql);
    $num_phone = 0;
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $num_phone = $row['ph_num'];
    }

    $sql2 = "SELECT * FROM bag WHERE bag_id=$id_bag";
    $result2 = mysqli_query($connect, $sql2);
    $num_bag = 0;
    while ($row = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
        $num_bag = $row['bag_num'];
    }

    $num = $num_phone + $num_bag;
    $sql3 = "UPDATE phone SET ph_num='$num' WHERE ph_id=$id_phone";
    $connect->query($sql3);

    $sql4 = "DELETE FROM bag WHERE bag_id=$id_bag";
    $connect->query($sql4);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
