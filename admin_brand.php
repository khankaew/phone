<?php
    include('db_connect.php');
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>ขายโทรศัพท์ออนไลน์ | Admin</title>
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
        <h4><b>สำหรับผู้ดูแลระบบ</b></h4>
        <p class="w3-text-grey">จัดการหลังร้าน</p>
      </div>
      <div class="w3-bar-block">
        <a href="admin_brand.php" class="w3-bar-item w3-button w3-padding w3-text-teal">จัดการยี่ห้อ</a>
        <a href="admin_add.php" class="w3-bar-item w3-button w3-padding">เพิ่มสินค้า</a>
        <a href="admin_phone.php" class="w3-bar-item w3-button w3-padding">รายการสินค้า</a>
        <a href="admin_sell.php" class="w3-bar-item w3-button w3-padding">รายการขาย</a>
        <a href="db_logout.php" class="w3-bar-item w3-button w3-padding">ออกจากระบบ</a>
      </div>
    </nav>

<div class="w3-main" style="margin-left:300px">
  <header id="portfolio">
    <div class="w3-container">
        <h3>จัดการยี่ห้อโทรศัพท์</h3>
    </div>
  </header>

  <div class="w3-row-padding">
      <div class="w3-container w3-white">
        <p><b>เพิ่มยี่ห้อ</b></p>
        <form action="db_insertBrand.php" method="get">
            <input class="w3-input w3-border" type="text" name="Brand" required>
            <br>
            <button type="submit" class="w3-button w3-green w3-margin-bottom">เพิ่ม</button>
        </form>
      </div>
  </div>

  <br>
  <div class="w3-row-padding">
      <div class="w3-container w3-white">
        <p><b>ยี่ห้อโทรศัพท์</b></p>
        <table class="w3-table w3-bordered">
            <tr>
              <th></th>
              <th style="width:100%">ยี่ห้อ</th>
            </tr>
            <?php
				$sql = "SELECT * FROM brand";
				$result = mysqli_query($connect, $sql);
				while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			?>
            <tr>
              <td>
                  <a href="admin_brandEdit.php?Id=<?php echo $row['br_id'] ?>"><button class="w3-button w3-orange">แก้ไข</button></a>
              </td>
              <td><?php echo $row['br_name'] ?></td>
            </tr>
            <?php } ?>
         </table>
         <br>
      </div>
  </div>
</div>

</body>
</html>
