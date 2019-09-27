<?php
include('db_connect.php');
session_start();
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

    <script
      src="https://code.jquery.com/jquery-1.12.4.js"
      integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
</head>

<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
    /* Modal image */
    #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }
    #myImg:hover {opacity: 0.7;}
    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1050; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }
    /* Modal Content (image) */
    .modal-content {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
    }
    /* Add Animation */
    .modal-content, #caption {
      -webkit-animation-name: zoom;
      -webkit-animation-duration: 0.6s;
      animation-name: zoom;
      animation-duration: 0.6s;
    }
    @-webkit-keyframes zoom {
      from {-webkit-transform:scale(0)}
      to {-webkit-transform:scale(1)}
    }
    @keyframes zoom {
      from {transform:scale(0)}
      to {transform:scale(1)}
    }
    /* The Close Button */
    .close {
      position: absolute;
      top: 15px;
      right: 35px;
      color: #f1f1f1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }
    .close:hover,
    .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }
    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
      .modal-content {
        width: 100%;
      }
    }
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
        <a href="admin_phone.php" class="w3-bar-item w3-button w3-padding">รายการสินค้า</a>
        <a href="admin_sell.php" class="w3-bar-item w3-button w3-padding w3-text-teal">รายการขาย</a>
        <a href="db_logout.php" class="w3-bar-item w3-button w3-padding">ออกจากระบบ</a>
      </div>
    </nav>

<div class="w3-main" style="margin-left:300px">
  <header id="portfolio">
    <div class="w3-container">
        <h3>รายการขาย</h3>
    </div>
  </header>

  <div class="w3-row-padding">
      <form action="report.php" method="get" target="_blank">
          <div class="w3-row">
              <div class="w3-col m1" style="text-align:right">
                  <h5 style="padding-right:10px">เลือกปี </h5>
              </div>
              <div class="w3-col m1">
                  <input class="w3-input w3-border" type="text" id="datepicker1" name="Year" required>
              </div>
              <div class="w3-col m1">
                  <button type="submit" class="w3-button w3-pink">พิมพ์รายงาน</button>
              </div>
          </div>
      </form>
      <div class="w3-container w3-white">
          <br>
        <table class="w3-table w3-bordered">
            <tr>
                <th>รหัสขาย</th>
                <th>สินค้า</th>
                <th>ราคา</th>
                <th>ข้อมูลผู้ซื้อ</th>
                <th>สถานะ</th>
                <th></th>
            </tr>
            <?php
                $num_row=1;
                $sql = "SELECT * FROM pay INNER JOIN user ON pay.pay_users=user.user_id ORDER BY pay.pay_id DESC";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $num_row++ ?></td>
                <td>
                    <?php
                        $id_bag = explode(',',$row['pay_bag']);
                        for ($i=0; $i < count($id_bag); $i++) {
                            $bag_id = $id_bag[$i];
                            $sql2 = "SELECT * FROM bag INNER JOIN phone ON bag.bag_phone=phone.ph_id WHERE bag.bag_id=$bag_id";
                            $result2 = mysqli_query($connect, $sql2);
                            while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
                                echo $row2['ph_name']." ".$row2['bag_num']." เครื่อง ".$row2['bag_price']." บาท<br>";
                            }
                        }
                     ?>
                </td>
                <td><?php echo $row['pay_price'] ?></td>
                <td>
                    <?php echo $row['user_name']." ".$row['user_address']." ".$row['user_phone'] ?>
                </td>
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
                    <?php if ($row['pay_status'] == 1): ?>
                        <button class="w3-button w3-blue" value="<?php echo $row['pay_slip'] ?>" onclick="Show(this.value)">สลิป</button>
                        <button class="w3-button w3-green">ส่งแล้ว</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
         </table>
         <br>
      </div>
  </div>

</div>

<!-- The Modal -->
<div id="myModal" class="modal">
<span class="close">&times;</span>
<img class="modal-content" id="img01">
<div id="caption"></div>
</div>
<!-- End The Modal -->

<script>
  function Show(src) {
      // Get the modal
      var modal = document.getElementById("myModal");
      var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = "images/"+src;

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks on <span> (x), close the modal
      span.onclick = function() {
          modal.style.display = "none";
      }
  }
      $(function() {
        $("#datepicker1").datepicker({ dateFormat: 'yy' });
    });

</script>
</body>
</html>
