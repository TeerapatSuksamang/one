<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหาร</title>
</head>
<body>
    <?php
    
        include_once 'nav.php';
        if(isset($_GET['rider_see_res'])){
            $_SESSION['rider_see_res'] = $_GET['rider_see_res'];
        }
        $rider_see_res = $_SESSION['rider_see_res']; 

        $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '$rider_see_res' AND `status` = 1 ");
        // *******
        if($select -> num_rows <= 0){
            header('location: index.php');
        }
        $row = mysqli_fetch_array($select);
    ?>
    <div class="banner position-relative">
        <div class="dark-overlay"></div>
        <img src="../upload/<?php echo $row['img'] ?>" class="img">
    </div>

    <div class="container my-3">
        <div class="mx-2">
            <h3>ร้านอาหาร : <?php echo $row['res_name'] ?></h3>
            <h5>ที่อยู่ : <?php echo $row['address'] ?> | ติดต่อ : <?php echo $row['phone'] ?></h5>
            <p>
                <?php
                    if($row['star'] > 0){
                        for($i=1; $i<=$row['star']; $i++){
                            echo '⭐';
                        } 
                        echo $row['star'].' คะแนน ('.$row['qty_sale'].'รีวิว)';
                    } else {
                        echo '⭐ ยังไม่มีคะแนน';
                    }
                ?>
            </p>
        </div>
    </div>
    <hr>

    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">รับออร์เดอร์</h1>
            <?php
            
                $member = 'rider';
                $rider_id = 'rider_id';
                $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 2 AND `res_id` = '$rider_see_res' ");

                if($select -> num_rows > 0){
                    include '../template/status.php';
                }else{

            
            ?>
                <p class="text-center blockquote-footer my-3">ยังไม่มีออร์เดอร์</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>