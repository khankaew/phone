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
        <a href="admin_brand.php" class="w3-bar-item w3-button w3-padding">จัดการยี่ห้อ</a>
        <a href="admin_add.php" class="w3-bar-item w3-button w3-padding w3-text-teal">เพิ่มสินค้า</a>
        <a href="admin_phone.php" class="w3-bar-item w3-button w3-padding">รายการสินค้า</a>
        <a href="admin_sell.php" class="w3-bar-item w3-button w3-padding">รายการขาย</a>
        <a href="db_logout.php" class="w3-bar-item w3-button w3-padding">ออกจากระบบ</a>
      </div>
    </nav>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <div class="w3-container">
        <h3>เพิ่มสินค้า</h3>
    </div>
  </header>

  <div class="w3-row-padding">
      <div class="w3-container w3-white">
        <p><b>ข้อมูลสินค้า</b></p>
        <form action="db_insertPhone.php" method="post" enctype="multipart/form-data">
            <label>ยี่ห้อ</label>
            <select class="w3-select" name="Brand">
                <?php
    				$sql = "SELECT * FROM brand";
    				$result = mysqli_query($connect, $sql);
    				while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
    			?>
                <option value="<?php echo $row['br_id'] ?>"><?php echo $row['br_name'] ?></option>
                <?php } ?>
            </select>
            <br><br>
            <label>ชื่อ</label>
            <input class="w3-input w3-border" type="text" name="Name" required>
            <br>
            <label>ราคา</label>
            <input class="w3-input w3-border" type="number" name="Price" required>
            <br>
            <label>จำนวน</label>
            <input class="w3-input w3-border" type="number" name="Num" required>
            <br>
            <label>รูปสินค้า</label>
            <input class="w3-input w3-border" type="file" name="Image" required>
            <br>
            <label>รายละเอียดเพิ่มเติม</label>
            <textarea class="w3-input w3-border" rows="8" cols="80" name="Detail" ></textarea>
            <br>
            <button type="submit" class="w3-button w3-green w3-margin-bottom">เพิ่ม</button>
        </form>
      </div>
  </div>

</div>

</body>
</html>
