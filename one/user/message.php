<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อความการแจ้งเตือน</title>
</head>
<body>
    <?php   
        include_once 'nav.php';
        if($un -> num_rows > 0){
            $sql = mysqli_query($conn, "UPDATE `message` SET `status` = 1 WHERE `member` = 'user' AND `member_id` = '".$_SESSION['user_id']."' ");
            if($sql){
                echo "<script>window.location.reload();</script>";
            }
        }
    ?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <h1 class="text-center mb-3">กล่องข้อความ</h1>
            <?php
                $select = mysqli_query($conn, "SELECT * FROM `message` WHERE `member` = 'user' AND `member_id` = '".$_SESSION['user_id']."' ");
                if($select -> num_rows > 0){
                    while($row = mysqli_fetch_array($select)){ 
            ?>
                <div class="card shadow p-0 mb-5">
                    <div class="card-header d-flex gap-2 p-3">
                        <?php echo $row['time']; ?>
                    </div>
                    <div class="card-body">
                        <h4><?php echo $row['msg'] ?></h4>
                    </div>
                </div>

            <?php }} else { ?>
                <p class="text-center blockquote-footer my-3">ยังไม่มีข้อความ</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>