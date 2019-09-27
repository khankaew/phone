<?php
    include('db_connect.php');
    $id = $_GET['ID'];
    error_reporting(0);
    session_start();
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
        <p class="w3-text-grey">ยี่ห้อโทรศัพท์</p>
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
        <h3><b>ข้อมูลสินค้า</b></h3>
    </div>
  </header>

  <div class="w3-row-padding">
      <div class="w3-container w3-white">
        <p><b>ข้อมูลสินค้า</b></p>
        <?php
              $sql = "SELECT * FROM phone INNER JOIN brand ON phone.ph_brand=brand.br_id WHERE phone.ph_id=$id";
              $result = mysqli_query($connect, $sql);
              while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
           ?>
        <div class="w3-row">
          <div class="w3-col s4">
              <img src="images/<?php echo $row['ph_image'] ?>" alt="" width="100%">
          </div>
          <div class="w3-col s8">
              <p><b><?php echo $row['ph_name'] ?></b> </p>
              <p><?php echo $row['br_name'] ?></p>
              <p>จำนวน <?php echo $row['ph_num'] ?> เครื่อง</p>
              <p>ราคาเครื่องละ <?php echo $row['ph_price'] ?> บาท</p>
              <p>รายละเอียดสินค้า : <?php echo $row['ph_detail'] ?></p>
              <hr>

              <form action="db_addBag.php" method="get">
                  <input type="number" name="Id" value="<?php echo $row['ph_id'] ?>" hidden>

                  <label>จำนวน</label>
                  <input class="w3-input w3-border" type="number" name="Num" min="1" style="width:200px" onchange="processPrice(this.value)" value="1" required>
                  <br>

                  <label>ราคา</label>
                  <input type="number" id="price1" value="<?php echo $row['ph_price'] ?>" hidden>
                  <input class="w3-input w3-border" id="price2" type="number" name="Price" style="width:200px" value="<?php echo $row['ph_price'] ?>" readonly>
                  <br>
                  <?php if ($_SESSION['Login']): ?>
                      <button type="submit" class="w3-button w3-green w3-margin-bottom">เพิ่มเข้าตะกร้า</button>
                  <?php else: ?>
                      <a href="page_login.php"><button type="button" class="w3-button w3-green w3-margin-bottom">เข้าสู่ระบบก่อน</button></a>
                  <?php endif; ?>
              </form>
          </div>
        </div>
        <?php } ?>
        <br>
      </div>
  </div>

</div>

    <script type="text/javascript">
      function processPrice(num) {
          var price = document.getElementById('price1').value;
          document.getElementById('price2').value = price * num;
      }
    </script>
</body>
</html>
