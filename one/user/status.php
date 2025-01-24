<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สถานะการสั่งซื้อ</title>
</head>
<body>
    <?php
    
        include_once 'nav.php';
        include_once 'session.php';
    
    ?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">สถานะการสั่งซื้อ</h1>
            <?php
                
                $member = 'user';
                $user_id = $_SESSION['user_id'];
                $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `user_id` = '$user_id' AND `status` BETWEEN 0 AND 6");

                if($select -> num_rows > 0){
                    include '../template/status.php';
                }else{
                    
            ?>
                <p class="text-center blockquote-footer my-3">ยังไม่มีสถานะการสั่งซื้อ</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>