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
        <a href="admin_add.php" class="w3-bar-item w3-button w3-padding">เพิ่มสินค้า</a>
        <a href="admin_phone.php" class="w3-bar-item w3-button w3-padding w3-text-teal">รายการสินค้า</a>
        <a href="admin_sell.php" class="w3-bar-item w3-button w3-padding">รายการขาย</a>
        <a href="db_logout.php" class="w3-bar-item w3-button w3-padding">ออกจากระบบ</a>
      </div>
    </nav>

<div class="w3-main" style="margin-left:300px">
  <header id="portfolio">
    <div class="w3-container">
        <h3>รายการสินค้า</h3>
    </div>
  </header>

  <div class="w3-row-padding">
      <div class="w3-container w3-white">
          <br>
        <table class="w3-table w3-bordered">
            <tr>
                <th>ลำดับ</th>
                <th style="width:10%">ยี่ห้อ</th>
                <th style="width:25%">ชื่อสินค้า</th>
                <th style="width:10%">ราคา</th>
                <th style="width:10%">จำนวน</th>
                <th style="width:20%">รายละเอียด</th>
                <th style="width:20%">รูป</th>
                <th></th>
            </tr>
            <?php
                $num = 1;
                $sql = "SELECT * FROM phone JOIN brand ON phone.ph_brand=brand.br_id";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $num++ ?></td>
                <td><?php echo $row['br_name'] ?></td>
                <td><?php echo $row['ph_name'] ?></td>
                <td><?php echo $row['ph_price'] ?></td>
                <td><?php echo $row['ph_num'] ?></td>
                <td><?php echo $row['ph_detail'] ?></td>
                <td><img src="images/<?php echo $row['ph_image'] ?>" alt="" width="100px"> </td>
                <td>
                    <a href="admin_phoneEdit.php?Id=<?php echo $row['ph_id'] ?>"><button class="w3-button w3-yellow">แก้ไข</button></a>
                    <button class="w3-button w3-red" onclick="myFunction(<?php echo $row['ph_id'] ?>)">ลบ</button>
                </td>
            </tr>
            <?php } ?>
         </table>
         <br>
      </div>
  </div>

</div>

<script>
    function myFunction(id) {
      if (confirm("ต้องการลบใช่หรือไม่!")) {
        window.location.href = 'db_deletePhone.php?Id='+id;
      }
    }
</script>
</body>
</html>
