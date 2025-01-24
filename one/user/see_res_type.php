<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>ประเภทร้านอาหาร</title>
</head>
<body>
    <?php
    
        include_once 'nav.php';
        if(isset($_GET['res_type'])){
            $res_type = $_GET['res_type'];
        } else {
            $res_type = '';
        }

    ?>
    <div class="container">
        <div class="row my-5">
            <h3>
                <a href="index.php?page=home" class="btn p-0"><h3>&#11148;</h3></a>
                <?php echo $res_type ?>
            </h3>

            <?php
                $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_type` = '$res_type' ");
                if($select -> num_rows > 0){
                    while($row = mysqli_fetch_array($select)){
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                    <a href="see_res.php" class="text-dark">
                        <div class="card hover-img shadow mb-3">
                            <div class="card-img-top hover-img" style="height: 200px;">
                                <img src="../upload/<?php echo $row['img'] ?>" class="img">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['res_name'] ?></h5>
                                <h6><?php echo $row['res_type'] ?> | ⭐<?php echo ($row['star'] == 0 ? 'ยังไม่มีคะแนน' : $row['star'].'คะแนน') ?></h6>
                                <p class="text-truncate"><?php echo $row['address'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php }} else { ?>
                <p class="text-center blockquote-footer my-5">ยังไม่มีร้านอาหารประเภทนี้</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>