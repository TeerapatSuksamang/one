<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขเมนูอาหาร</title>
</head>
<body>
    <?php
    
        include_once 'nav.php';
        $food_id = ($_GET['food_id'] ?: 0);
        $res_id = $_SESSION['res_id'];
        $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' AND `res_id` = '$res_id' ");
        if($select -> num_rows > 0){
            // header('location: index.php');
        // }
        $row = mysqli_fetch_array($select);
    ?>
    <!-- **** -->
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-md-6">
                    <form action="food_manage.php" class="card shadow p-3" method="post" enctype="multipart/form-data">
                        <h1 class="text-center mb-4">แก้ไขเมนูอาหาร</h1>
                        <input type="hidden" name="food_id" value="<?php echo $food_id ?>">
                        <input type="hidden" name="discount" value="<?php echo $row['discount'] ?>">

                        <label for="">ชื่อเมนู</label>
                        <input type="text" class="form-control mb-4" name="food_name" value="<?php echo $row['food_name'] ?>" required>

                        <label for="">รูปภาพ</label>
                        <center>
                            <img src="../upload/<?php echo $row['img'] ?>" class="border mb-2 rounded" style="width: 10rem;" id="preview">
                        </center>
                        <input type="file" class="form-control mb-4" name="img" id="img_upload">

                        <label for="">ราคา</label>
                        <input type="number" class="form-control mb-4" name="price" value="<?php echo $row['price'] ?>" required>

                        <label for="">หมวดหมู่อาหาร</label>
                        <select name="food_type" class="form-select mb-4">
                            <option value="<?php echo $row['food_type'] ?>"><?php echo $row['food_type'] ?></option>
                            <?php
                                $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '$res_id' AND `food_type` != '".$row['food_type']."' ");
                                while($row_type = mysqli_fetch_array($select_type)){
                            ?>
                                <option value="<?php echo $row_type['food_type'] ?>"><?php echo $row_type['food_type'] ?></option>
                            <?php } ?>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>

                        <div class="d-flex gap-3">
                            <a href="index.php?page=home" class="btn btn-outline-danger w-100">ย้อนกลับ</a>
                            <input type="submit" class="btn btn-success w-100" name="food_edit" value="ยืนยัน">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <p class="text-center blockquote-footer my-5">ไม่พบเมนูอาหารที่คุณต้องการแก้ไข</p>
    <?php } ?>

    <script src="../function.js"></script>
</body>
</html>