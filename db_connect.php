<?php

    $hostname = "localhost";
    $user = "root";
    $password = "";
    $dbname = "phone";


    $connect = mysqli_connect($hostname, $user, $password, $dbname) or die("Error");
    mysqli_set_charset($connect, "utf8");
?>
