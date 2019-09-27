<?php
    include("db_connect.php");
    session_start();

    $users = $_SESSION['Id'];
    $id = $_GET['Id'];
    $num = $_GET['Num'];
    $price = $_GET['Price'];

    $sql = "SELECT * FROM phone WHERE ph_id=$id";
    $result = mysqli_query($connect, $sql);
    $new_num = 0;
    while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $new_num = $row['ph_num'] - $num;
    }
    $sql2 = "UPDATE phone SET ph_num='$new_num' WHERE ph_id=$id";
    $connect->query($sql2);

    $sql3 = "INSERT INTO bag VALUES ('Null', '$users', '$id', '$num', '$price', 'Null')";
    $connect->query($sql3);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
