<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาเมนูอาหาร</title>
</head>
<body>
    <?php

        include_once 'nav.php';
        if(isset($_GET['see_res'])){
            $_SESSION['see_res'] = $_GET['see_res'];
        }
        $see_res = $_SESSION['see_res'];

        if(!isset($_SESSION['cart_arr'][$see_res])){
            $_SESSION['cart_arr'][$see_res] = array();
        }

        $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '$see_res' AND `status` = 1 ");
        // *******
        if($select -> num_rows <= 0){
            header('location: index.php');
        }
        $row = mysqli_fetch_array($select);

        if(isset($_GET['find'])){
            $find = $_GET['find'];
        } else {
            $find = '';
        }
    ?>
    <div class="container">
        <div class="row my-5">
            <h3>
                <a href="see_res.php?" class="btn p-0"><h3>&#11148;</h3></a>
                ค้นหาเมนูอาหาร
            </h3>

            <form action="search.php" class="form-control shadow d-flex gap-2 p-3 mb-3" method="get">
                <input type="search" class="form-control" name="find" placeholder="กินไรดีสุดหล่อ" value="<?php echo $find ?>">
                <?php if($find != ''){ ?>
                    <a href="search.php" class="btn btn-warning text-nowrap">รีเซ็ท</a>
                <?php } ?>
                <input type="submit" class="btn btn-primary" value="ค้นหา">
            </form>

            <?php
                if($find != ''){
                    $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_name` LIKE '%$find%' AND `res_id` = '$see_res' ");
                } else {
                    $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `res_id` = '$see_res' ");
                }
                if($select -> num_rows > 0){
                    while($row = mysqli_fetch_array($select)){
                        include 'food_item.php';
                        include 'food_modal.php';
                    }
                } else {
            ?>
                <p class="text-center blockquote-footer my-3">ไม่พบเมนูที่ค้นหา</p>
            <?php } ?>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3">
        <a href="cart.php" class="position-relative btn btn-outline-primary">
            <h3>🛒</h3>
            <?php if(count($_SESSION['cart_arr'][$see_res]) > 0){ ?>
                <span class="position-absolute top-0 start-100 rounded-pill bg-danger translate-middle badge"><?php echo count($_SESSION['cart_arr'][$see_res]) ?></span>
            <?php } ?>
        </a>
    </div>
</body>
</html>