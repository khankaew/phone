<?php
    include('db_connect.php');
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>ขายโทรศัพท์ออนไลน์</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>

<body class="w3-light-grey w3-content" style="max-width:1600px">

    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
      <div class="w3-container">
        <a href="index.php"><h4><b>ชื่อร้าน</b></h4></a>
      </div>
      <div class="w3-bar-block">
          <a href="index.php" class="w3-bar-item w3-button w3-padding">สินค้าทั้งหมด</a>
          <?php
              $sql = "SELECT * FROM brand";
              $result = mysqli_query($connect, $sql);
              while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
          ?>
            <a href="index2.php?Id=<?php echo $row['br_id'] ?>&Brand=<?php echo $row['br_name'] ?>" class="w3-bar-item w3-button w3-padding">
                <?php echo $row['br_name'] ?>
            </a>
          <?php } ?>
          <a href="page_register.php" class="w3-bar-item w3-button w3-padding">สมัครสมาชิก</a>
          <a href="page_login.php" class="w3-bar-item w3-button w3-padding">เข้าสู่ระบบ</a>
      </div>
    </nav>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <div class="w3-container">
        <h3>เข้าสู่ระบบ</h3>
    </div>
  </header>

  <div class="w3-row-padding">
      <div class="w3-container w3-white">
        <p><b>เข้าสู่ระบบ</b></p>
        <form action="db_login.php" method="post">

            <label>ชื่อผู้ใช้</label>
            <input class="w3-input w3-border" type="text" name="Username" required>
            <br>

            <label>รหัสผ่าน</label>
            <input class="w3-input w3-border" type="password" name="Password" required>
            <br>

            <button type="submit" class="w3-button w3-green w3-margin-bottom">เข้าสู่ระบบ</button>
        </form>
      </div>
  </div>

</div>

</body>
</html>
