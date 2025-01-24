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
        if(isset($_GET['see_res'])){
            $_SESSION['see_res'] = $_GET['see_res'];
        }
        $see_res = $_SESSION['see_res']; 

        $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '$see_res' AND `status` = 1 ");
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
                    star($row['star'], $row['qty_sale']);
                ?>
            </p>
        </div>
    </div>

    <ul class="nav nav-tabs ps-5 mb-5" id="review">
        <li class="nav-item ms-5">
            <a href="see_res.php#food" class="nav-link">เมนูอาหาร</a>
        </li>
        <li class="nav-item">
            <a href="see_review.php#review" class="nav-link active">รีวิวร้าน</a>
        </li>
    </ul>

    <div class="container">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">รีวิวร้านอาหาร</h1>
            <?php
                $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `status` = 7 AND `res_id` = '".$_SESSION['see_res']."' ");
                if($select -> num_rows > 0){
                    while($row = mysqli_fetch_array($select)){
                        $select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '".$row['user_id']."' ");
                        $row_user = mysqli_fetch_array($select_user);
            ?>
                <div class="card shadow p-0 mb-5">
                    <div class="card-header d-flex gap-2 p-3">
                        <div class="rounded-circle hover-img border" style="width: 5rem; height: 5rem;">
                            <img src="../upload/<?php echo $row_user['img'] ?>" class="img">
                        </div>
                        <h5 class="align-items-center d-flex">
                            <?php echo $row['full_name'] ?>
                            <br>
                            <?php star($row['star']); ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <span class="text-secondary"><?php echo $row['date'] ?> | <?php echo $row['time'] ?></span>
                        <h4><?php echo $row['review'] ?></h4>
                        <span class="text-secondary">รายการอาหารที่สั่ง : 
                            <?php
                                $select_food = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_id` = '".$row['order_id']."' ");
                                while($row_food = mysqli_fetch_array($select_food)){
                                    echo $row_food['food_name'].', ';
                                }
                            ?>
                        </span>
                    </div>
                </div>
            <?php }} else { ?>
                <p class="text-center blockquote-footer my-3">ยังไม่มีรีวิวของร้าน</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>