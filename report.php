<?php
include('db_connect.php');
$year = $_GET['Year'];
require_once __DIR__ . '/vendor/autoload.php';

$html = '
    <html>
    <head>
    <style>
    body {font-family: garuda;
    	font-size: 10pt;
    }
    table{
      border-collapse: collapse;
      width: 100%;
      margin: 10px;
    }
    tr th, table tr td {
      border: 1px solid black;
    }
    </style>
    </head>
';
$html .= '
    <body>
        <div style="text-align:center">
            <h2>รายงานการขายรายปี</h2>
        </div>
';
    $html .= '<table>
                <thead>
                    <tr>
                        <th style="width:10%">ลำดับ</th>
                        <th style="width:45%">สินค้า</th>
                        <th style="width:10%">ราคา</th>
                        <th style="width:30%">ผู้ซื้อ</th>
                        <th style="width:15%">วันที่ขาย</th>
                    </tr>
                </thead>
                <tbody>';
                $year = $_GET['Year'];
                $num_row=1;
                $sql = "SELECT * FROM pay INNER JOIN user ON pay.pay_users=user.user_id WHERE pay.pay_date LIKE %$year% ORDER BY pay.pay_id ASC";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                    $html .= '
                        <tr>
                            <td style="text-align:center">'.$num_row++.'</td>
                            <td>';
                                $id_bag = explode(',',$row['pay_bag']);
                                for ($i=0; $i < count($id_bag); $i++) {
                                    $bag_id = $id_bag[$i];
                                    $sql2 = "SELECT * FROM bag INNER JOIN phone ON bag.bag_phone=phone.ph_id WHERE bag.bag_id=$bag_id";
                                    $result2 = mysqli_query($connect, $sql2);
                                    while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
                                        $html .= $row2['ph_name']." ".$row2['bag_num']." เครื่อง ".$row2['bag_price']." บาท<br>";
                                    }
                                }
                    $html .= '</td>
                            <td style="text-align:center">'.$row['pay_price'].'</td>
                            <td>'.$row['user_name'].' '.$row['user_address'].'</td>
                            <td style="text-align:center">'.$row['pay_date'].'</td>
                        </tr>
                    ';
                }
    $html .= '</tbody>
            </table>';

$html .= '</body></html>';


$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('report', 'I');
