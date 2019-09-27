<?php
    error_reporting(0);
    include('db_connect.php');
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
        <h3><b>ข้อมูลการสั่งซื้อ</b></h3>
    </div>
  </header>

  <div class="w3-row-padding">
      <div class="w3-container w3-white">
          <br>
          <table class="w3-table w3-bordered">
              <thead>
                <tr>
                  <th>รหัสการซื้อ</th>
                  <th>สินค้า</th>
                  <th>ราคา</th>
                  <th>วันที่</th>
                  <th>สถานะ</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      $sql = "SELECT * FROM pay WHERE pay_users=$users ORDER BY pay_id DESC";
                      $result = mysqli_query($connect, $sql);
                      while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $row['pay_id'] ?></td>
                      <td>
                          <?php
                              $id_bag = explode(',',$row['pay_bag']);
                              for ($i=0; $i < count($id_bag); $i++) {
                                  $bag_id = $id_bag[$i];
                                  $sql2 = "SELECT * FROM bag INNER JOIN phone ON bag.bag_phone=phone.ph_id WHERE bag.bag_id=$bag_id";
                                  $result2 = mysqli_query($connect, $sql2);
                                  while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
                                      echo $row2['ph_name']." ".$row2['bag_num']." เครื่อง <br>";
                                  }
                              }
                           ?>
                      </td>
                      <td><?php echo $row['pay_price'] ?></td>
                      <td><?php echo $row['pay_date'] ?></td>
                      <td>
                          <?php
                              if ($row['pay_status'] == 0) {
                                  echo "รอชำระเงิน";
                              }elseif ($row['pay_status'] == 1) {
                                  echo "ชำระเงินแล้ว รอจัดส่ง";
                              }else {
                                  echo "จัดส่งแล้ว";
                              }
                           ?>
                      </td>
                      <td>
                          <?php if ($row['pay_status'] == 0): ?>
                              <a href="send.php?IdPay=<?php echo $row['pay_id'] ?>"><button type="button" class="w3-button w3-green">แจ้งชำระเงิน</button></a>
                          <?php else: ?>
                              <button type="button" class="w3-button w3-green" disabled>แจ้งชำระเงินแล้ว</button>
                          <?php endif; ?>
                      </td>
                    </tr>
                  <?php } ?>
              </tbody>
            </table>
             <br><br>
       </div>
  </div>

</div>

</body>
</html>
