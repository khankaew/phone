<?php
    include("db_connect.php");
    session_start();

    $arr_id = $_GET['IdBag'];
    $str_id = implode(',',$arr_id);
    $users_id = $_SESSION['Id'];
    $price = $_GET['Price'];
    $date = date('Y-m-d');
    $status = 0;

    for ($i=0; $i < count($arr_id); $i++) {
        $bag_id = $arr_id[$i];
        $sql = "UPDATE bag SET bag_ordered=1 WHERE bag_id=$bag_id";
        $connect->query($sql);
    }
    $sql3 = "INSERT INTO pay VALUES ('Null', '$users_id', '$str_id', '$price', '$date', '$status', 'Null')";
    $connect->query($sql3);

    header('Location: page_pay.php');
?>
