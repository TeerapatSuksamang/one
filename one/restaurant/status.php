<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ออร์เดอร์ขณะนี้</title>
</head>
<body>
    <?php
    
        include_once 'nav.php';
    
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">ออร์เดอร์ขณะนี้</h1>
            <?php
                
                $member = 'restaurant';
                $res_id = $_SESSION['res_id'];
                $select = mysqli_query($conn, "SELECT * FROM `order_detail` WHERE `res_id` = '$res_id' AND `status` BETWEEN 0 AND 6");

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