<?php
  include("db_connect.php");
  session_start();
  $username = $_POST['Username'];
  $password = $_POST['Password'];
  $strSQL = "SELECT * FROM user WHERE user_username='$username' AND user_password='$password'";
  $result = mysqli_query($connect, $strSQL);
  if (mysqli_num_rows($result) > 0) {
      $_SESSION["Login"] = true;
      while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
          $_SESSION["Id"] = $row['user_id'];
          $_SESSION["Username"] = $row['user_username'];
          $_SESSION["IsAdmin"] = $row['user_status'];
      }
      session_write_close();
      if ($_SESSION['IsAdmin'] == 0) {
          header("location: index.php");
      }else {
          header("location: admin.php");
      }
  }else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
?>
