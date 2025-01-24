<?php

    include 'nav.php';
    require_once __DIR__ . "/vendor/autoload.php";

    $mpdf = new \Mpdf\Mpdf([
        'default_font_size' => '18',
        'default_font' => 'sarabun'
    ]);

    $mpdf->SetFont('sarabun','',16);

    ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>ดูใบเสร็จ</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>
<body>

    <?php   
        if(isset($_GET['order_id'])){
            $order_id = $_GET['order_id'];
        } else {
            $order_id = 0;
        }

        $select_order = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `order_id` = '$order_id' AND `res_id` = '".$_SESSION['res_id']."' ");
        // ****
        if($select_order -> num_rows <= 0){
            echo "<script>window.history.back()</script>";
        }
        $row_order = mysqli_fetch_array($select_order);
    ?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="card shadow p-3">
                    <div class="text-center">
                        <h2 style="font-weight: bold; font-size: 1.5rem;">ร้านอาหาร : <?php echo $row['res_name'] ?></h2>
                        <h6><?php echo $row['address'] ?></h6>
                        <h6><?php echo $row_order['date'] ?> | <?php echo $row_order['time'] ?></h6>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table-sm w-100">
                            <thead>
                                <?php
                                    $select_food = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_id` = '$order_id' ");
                                    while($row_food = mysqli_fetch_array($select_food)){
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $row_food['food_name'] ?> x <?php echo $row_food['qty'] ?>
                                            <?php if($row_food['new_price'] != 0){ ?>
                                                (<s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                                <span class="text-success"><?php echo '฿'.$row_food['new_price'] ?></span>)
                                            <?php } else { ?>
                                                <?php echo '(฿'.$row_food['price'].')' ?>
                                            <?php } ?>
                                        </td>

                                        <td style="" align="right"><?php echo $row_food['total_price'] ?></td>
                                    </tr>
                                <?php } ?>
                                
                                <?php if($row_order['cpn_discount'] != 0){ ?>
                                    <tr>
                                        <td style="font-weight: bold;">ค่าอาหาร</td>
                                        <td style="font-weight: bold;" align="right">฿<?php echo $row_order['all_price'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">ส่วนลด</td>
                                        <td style="font-weight: bold;" align="right">- <?php echo $row_order['cpn_discount'] ?>%</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;">ทั้งหมด</td>
                                        <td style="font-weight: bold;" align="right">฿<?php echo $row_order['sum_price'] ?></td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td style="font-weight: bold;">ทั้งหมด</td>
                                        <td style="font-weight: bold;" align="right">฿<?php echo $row_order['sum_price'] ?></td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td style="font-weight: bold;">การชำระเงิน</td>
                                    <td style="font-weight: bold;" align="right"><?php echo ($row_order['slip'] != 0 ? 'โอนจ่าย' : 'เงินสด') ?></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <hr>
                    <h5 style="font-weight: bold;">ข้อมูลผู้สั่ง</h5>
                    <h6>ชื่อผู้สั่ง : <?php echo $row_order['full_name'] ?></h6>
                    <h6>ที่อยู่ : <?php echo $row_order['address'] ?></h6>
                    <h6>เบอร์โทร : <?php echo $row_order['phone'] ?></h6>
                </div>
            </div>
        </div>
    </div>

    <?php
    
        $html = ob_get_contents();
        $mpdf->WriteHTML($html);
        $mpdf->OutPut('Receipt.pdf');

        ob_end_flush();
    
    ?>

    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-4">
                <div class="d-flex gap-2">
                    <a href="report.php" class="btn btn-outline-secondary w-100">ย้อนกลับ</a>
                    <a href="Receipt.pdf" class="btn btn-primary w-100">พิมพ์</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>