<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านโปรด</title>
</head>
<body>
    <?php
        include_once 'nav.php';
    ?>
    <div class="container">
        <div class="row my-5">
            <h1 class="text-center mb-3">ร้านโปรด</h1>
            <?php
                // $select = mysqli_query($conn, "SELECT * FROM `favorite` WHERE `user_id` = '".$_SESSION['user_id']."' ");
                $select = mysqli_query($conn, "SELECT `res`.*, `fav`.* 
                    FROM `restaurant` res
                    JOIN `favorite` fav 
                    ON `fav`.`res_id` = `res`.`res_id` 
                    WHERE `fav`.`user_id` = '{$_SESSION['user_id']}' ");
                if($select -> num_rows > 0){
                    // while($row = mysqli_fetch_array($select)){
                        // $select_res = mysqli_query($conn, "SELECT *FROM `restaurant` WHERE `res_id` = '".$row['res_id']."' ");
                        // $row = mysqli_fetch_array($select_res);
            ?>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                    <a href="see_res.php?see_res=<?php echo $row['res_id'] ?>" class="text-dark position-relative">
                        <div class="card hover-img shadow mb-3">
                            <div class="card-img-top hover-img" style="height: 200px;">
                                <img src="../upload/<?php echo $row['img'] ?>" class="img">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['res_name'] ?></h5>
                                <h6><?php echo $row['res_type'] ?> | ⭐<?php echo ($row['star'] == 0 ? 'ยังไม่มีคะแนน' : $row['star'].'คะแนน') ?></h6>
                                <p class="text-truncate"><?php echo $row['address'] ?></p>
                            </div>
                            
                            <span class="position-absolute end- text-danger mx-1"><h3>❤</h3></span>
                        </div>
                    </a>
                </div>

            <?php }} else { ?>
                <p class="text-center blockquote-footer my-3">ยังไม่มีร้านที่ชอบ</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>