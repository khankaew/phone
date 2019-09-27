<?php
    error_reporting(0);
    session_start();
    include('db_connect.php');
    $id = $_GET['Id'];
    $brand = $_GET['Brand'];
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
    .num-product{
        border: 1px solid pink;
        border-radius: 50%;
        background-color: pink;
        padding: 4px 8px;
        color: red;
    }
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
          <?php if ($_SESSION['Login']): ?>
              <?php if ($_SESSION['Id'] == 1): ?>
                  <a href="admin.php" class="w3-bar-item w3-button w3-padding"><?php echo $_SESSION['Username'] ?></a>
              <?php else: ?>
                  <a href="page_bag.php" class="w3-bar-item w3-button w3-padding">ตะกร้าสินค้า
                      <span class="num-product">
                        <?php
                        $users = $_SESSION['Id'];
                        $strSQL = "SELECT * FROM bag WHERE bag_users='$users' AND bag_ordered=0";
                        $result = mysqli_query($connect, $strSQL);
                        echo mysqli_num_rows($result);
                         ?>
                    </span>
                  </a>
                  <a href="page_pay.php" class="w3-bar-item w3-button w3-padding">ข้อมูลการสั่งซื้อ</a>
                  <a href="#" class="w3-bar-item w3-button w3-padding"><?php echo $_SESSION['Username'] ?></a>
              <?php endif; ?>
              <a href="db_logout.php" class="w3-bar-item w3-button w3-padding">ออกจากระบบ</a>
          <?php else: ?>
              <a href="page_register.php" class="w3-bar-item w3-button w3-padding">สมัครสมาชิก</a>
              <a href="page_login.php" class="w3-bar-item w3-button w3-padding">เข้าสู่ระบบ</a>
          <?php endif; ?>
      </div>
    </nav>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <div class="w3-container">
        <h3><b>รายการสินค้าของ <?php echo $brand ?></b></h3>
    </div>
  </header>

  <div class="w3-row-padding">
      <?php
          $sql = "SELECT * FROM phone WHERE ph_brand=$id";
          $result = mysqli_query($connect, $sql);
          while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
      ?>
        <div class="w3-third w3-container w3-margin-bottom">
            <a href="index_phone.php?ID=<?php echo $row['ph_id'] ?>">
                <img src="images/<?php echo $row['ph_image'] ?>" alt="Norway" style="width:100%">
            </a>
            <div class="w3-container w3-white">
                <p><b><?php echo $row['ph_name'] ?></b></p>
             </div>
        </div>
      <?php } ?>
  </div>

</div>

</body>
</html>
