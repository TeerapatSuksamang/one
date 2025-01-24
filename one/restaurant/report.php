<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานสรุปยอดขาย</title>
</head>
<body>
    <?php
    
        include_once 'nav.php';
    
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">รายงานสรุปยอดขาย วัน/เดือน/ปี</h1>
            <div class="col-md-8">
                <form action="report.php" class="d-flex gap-2" method="get">
                    <?php
                        if(isset($_GET['date1'])){
                            $date1 = $_GET['date1'];
                        } else {
                            $date1 = '';
                        }

                        if(isset($_GET['date2'])){
                            $date2 = $_GET['date2'];
                        } else {
                            $date2 = '';
                        }
                    ?>
                    <input type="date" class="form-control" name="date2" value="<?php echo $date1 ?>">
                    <input type="date" class="form-control" name="date1" value="<?php echo $date2 ?>">
                    <?php
                
                        $member = 'restaurant';
                        $res_id = $_SESSION['res_id'];

                        if($date1 != '' && $date2 != ''){
                    ?>
                        <a href="report.php" class="btn btn-warning" style="text-wrap: nowrap;">รีเซ็ท</a>
                    <?php } ?>
                    <input type="submit" class="btn btn-primary" name="submit" value="ค้นหา">
                </form>

                <?php
                    if($date1 != '' && $date2 != ''){
                        $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `res_id` = '$res_id' AND `status` = 7 AND `date` BETWEEN '$date1' AND '$date2' ");
                        $select1 = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `res_id` = '$res_id' AND `status` = 7 AND `date` BETWEEN '$date1' AND '$date2' ");
                    } else {
                        $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `res_id` = '$res_id' AND `status` = 7 ");
                        $select1 = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `res_id` = '$res_id' AND `status` = 7 ");
                    }

                    $sum_price = 0;
                    if($select1 -> num_rows > 0){
                        while($row1 = mysqli_fetch_array($select1)){
                            $sum_price += $row1['sum_price'];
                        }
                    } else {
                        $sum_price = 0;
                    }
                ?>
                    <p class="text-success my-3">รายได้รวมทั้งสิ้น <?php echo $sum_price ?> บาท</p>
            </div>
                <?php

                        // $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `res_id` = '$res_id' AND `status` = 7");

                    if($select -> num_rows > 0){
                        include '../template/status.php';
                    }else{

                ?>
                    <p class="text-center blockquote-footer my-3">ยังไม่มีรายงาน</p>
                <?php } ?>
        </div>
    </div>
</body>
</html>