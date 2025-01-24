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

        if(!isset($_SESSION['cart_arr'][$see_res])){
            $_SESSION['cart_arr'][$see_res] = array();
        }

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
            <h3>
                ร้านอาหาร : <?php echo $row['res_name'] ?> 
                
                <?php
                    $fav = mysqli_query($conn, "SELECT * FROM `favorite` WHERE `user_id` = '".$_SESSION['user_id']."' AND `res_id` = '$see_res' ");
                    $row_fav = mysqli_fetch_array($fav);
                    if($fav -> num_rows > 0){
                ?> 
                    <a href="add_fav.php?un_fav=<?php echo $row_fav['fav_id'] ?>" class="float-end fav">
                        <span class="text-danger">❤</span>
                    </a>
                <?php } else { ?>
                    <a href="add_fav.php?fav=<?php echo $see_res ?>" class="float-end fav">
                        <span>❤</span>
                    </a>
                <?php } ?>
            </h3>
            <h5>ที่อยู่ : <?php echo $row['address'] ?> | ติดต่อ : <?php echo $row['phone'] ?></h5>
            <p>
                <?php
                    star($row['star'], $row['qty_sale']);
                ?>
            </p>
        </div>
    </div>

    <ul class="nav nav-tabs ps-5 mb-5" id="food">
        <li class="nav-item ms-5">
            <a href="see_res.php#food" class="nav-link active">เมนูอาหาร</a>
        </li>
        <li class="nav-item">
            <a href="see_review.php#review" class="nav-link">รีวิวร้าน</a>
        </li>
    </ul>

    <div class="container-fluid">
        <div class="row my-5">
            <h1 class="text-center mb-3">หมวดหมู่อาหาร</h1>
            <?php
                $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '$see_res' ");
                if($select_type -> num_rows > 0){
                    while($row_type = mysqli_fetch_array($select_type)){
            ?>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1">
                    <a href="#<?php echo $row_type['food_type'] ?>" class="text-dark">
                        <div class="card hover-img shadow mb-3">
                            <div class="card-img-top hover-img" style="height: 200px;">
                                <img src="../upload/<?php echo $row_type['img'] ?>" class="img">
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title"><?php echo $row_type['food_type'] ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php }} else { ?>
                <p class="text-center blockquote-footer my-3">ยังไม่มีหมวดหมู่อาหารในร้าน</p>
            <?php } ?>
        </div>
    </div>

    <div class="navbar navbar-expand navbar-light bg-light shadow sticky-top">
        <a href="search.php" class="btn btn-outline-primary mx-2">🔍</a>
        <ul class="navbar-nav">
            <?php
                $pro = mysqli_query($conn, "SELECT * FROM `food` WHERE `discount` != 0 AND  `res_id` = '$see_res' ");
                if($pro -> num_rows > 0){
            ?>
                <li class="nav-item">
                    <a href="#promotion" class="nav-link">โปรโมชั่น</a>
                </li>
            <?php } ?>

            <?php
                $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '$see_res' ");
                while($row_type = mysqli_fetch_array($select_type)){
            ?>
                <li class="nav-item">
                    <a href="#<?php echo $row_type['food_type'] ?>" class="nav-link"><?php echo $row_type['food_type'] ?></a>
                </li>
            <?php } ?>

            <?php
                $more = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_type` = 'อื่นๆ' AND  `res_id` = '$see_res' ");
                if($more -> num_rows > 0){
            ?>
                <li class="nav-item">
                    <a href="#อื่นๆ" class="nav-link">อื่นๆ</a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="container">
        <?php if($pro -> num_rows > 0){ ?>
            <div class="pt-5" id="promotion">
                <h1 class="mt-4">โปรโมชั่น</h1>
                <div class="row">
                    <?php
                        $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `discount` != 0 AND  `res_id` = '$see_res' ");
                        while($row = mysqli_fetch_array($select)){
                            include 'food_item.php';
                        }
                    ?>
                </div>
            </div>
            <hr>
        <?php } ?>

        <?php
            $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '$see_res' ");
            while($row_type = mysqli_fetch_array($select_type)){
        ?>
            <div class="pt-5" id="<?php echo $row_type['food_type'] ?>">
                <h1 class="mt-4"><?php echo $row_type['food_type'] ?></h1>
                <div class="row">
                    <?php
                        $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_type` = '".$row_type['food_type']."' AND `res_id` = '$see_res' ");
                        while($row = mysqli_fetch_array($select)){
                            include 'food_item.php';
                        }
                    ?>
                </div>
            </div>
            <hr>
        <?php } ?>

        <?php if($pro -> num_rows > 0){ ?>
            <div class="pt-5" id="อื่นๆ">
                <h1 class="mt-4">อื่นๆ</h1>
                <div class="row">
                    <?php
                        $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_type` = 'อื่นๆ' AND  `res_id` = '$see_res' ");
                        while($row = mysqli_fetch_array($select)){
                            include 'food_item.php';
                        }
                    ?>
                </div>
            </div>
            <hr>
        <?php } ?>
    </div>

    <?php
        $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `res_id` = '$see_res' ");
        while($row = mysqli_fetch_array($select)){
            include 'food_modal.php';
        }
    ?>

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