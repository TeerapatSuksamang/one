<div class="container-fluid">
    <div class="row my-5">
        <h1 class="text-center mb-3">หมวดหมู่อาหาร</h1>
        <?php
            $res_id = $_SESSION['res_id'];
            $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '$res_id' ");
            if($select_type -> num_rows > 0){
                    // * แบบไม่ใช้ function
                    // $action = 'food_manage.php?';
                    // $do = 'del_type';
                while($row_type = mysqli_fetch_array($select_type)){
                    // $msg = 'ต้องการลบหมวดหมู่ '.$row_type['food_type'].' หรือไม่';
                    // $id = $row_type['food_type_id'];
                    // include '../template/confirm.php';

                    // แบบใช้ function
                    $msg = 'ต้องการลบหมวดหมู่ '.$row_type['food_type'].' หรือไม่';
                    $target = confirm('food_manage.php', 'del_type', $row_type['food_type_id'], $msg);
        ?>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6 p-1">
                <div class="card hover-img shadow mb-3">
                    <div class="card-img-top hover-img" style="height: 200px;">
                        <img src="../upload/<?php echo $row_type['img'] ?>" class="img">
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title"><?php echo $row_type['food_type'] ?></h4>
                        <!-- <a href="food_manage.php?del_type=<?php echo $row_type['food_type_id'] ?>" class="btn btn-danger" onclick="return confirm('ต้องการลบหมวดหมู่ <?php echo $row_type['food_type'] ?> หรือไม่?')">ลบ</a> -->

                        <!-- บั้ม -->
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#<?php echo $target ?>">ลบ</button>
                        <!-- 
                            no function = echo $do.$id
                            funtion = echo $target (มาจากตอนเรียกใช้ function)
                         -->
                    </div>
                </div>
            </div>
        <?php }} else { ?>
            <p class="text-center blockquote-footer my-3">ยังไม่มีหมวดหมู่อาหาร</p>
        <?php } ?>
        
        <div class="col-md-12 my-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_food_type">เพิ่มหมวดหมู่อาหาร</button>
        </div>

        <form action="food_manage.php" class="modal fade" id="add_food_type" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มหมวดหมู่อาหาร</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">หมวดหมู่อาหาร</label>
                        <input type="text" class="form-control mb-3" name="food_type" required>

                        <label for="">รูปภาพ</label>
                        <input type="file" class="form-control mb-3" name="img" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button> 
                        <input type="submit" class="btn btn-success" name="add_food_type" value="บันทึก">
                    </div>
                </div>
            </div>
        </form>

        <h2>เมนูอาหาร
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#add_food">เพิ่มเมนูอาหาร</button>
        </h2>

        <form action="food_manage.php" class="modal fade" id="add_food" method="post" enctype="multipart/form-data">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">เพิ่มเมนูอาหาร</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">ชื่อเมนู</label>
                        <input type="text" class="form-control mb-3" name="food_name" required>

                        <label for="">รูปภาพ</label>
                        <input type="file" class="form-control mb-3" name="img" required>

                        <label for="">ราคา</label>
                        <input type="number" class="form-control mb-3" name="price" required>

                        <label for="">หมวดหมู่อาหาร</label>
                        <select name="food_type" class="form-select mb-3">
                            <?php
                                $select_type = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `res_id` = '$res_id' ");
                                    while($row_type = mysqli_fetch_array($select_type)){
                            ?>
                                <option value="<?php echo $row_type['food_type'] ?>"><?php echo $row_type['food_type'] ?></option>
                            <?php } ?>
                            <option value="อื่นๆ">อื่นๆ</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button> 
                        <input type="submit" class="btn btn-success" name="add_food" value="บันทึก">
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive mb-3">
            <table class="table table-striped table-hover table-bordered text-center shadow">
                <tr>
                    <th>เมนูอาหาร</th>
                    <th>รูปภาพ</th>
                    <th>ราคา</th>
                    <th>หมวดหมู่อาหาร</th>
                    <th>จัดการ</th>
                </tr>

                <?php
                // ******
                    $select = mysqli_query($conn, "SELECT `food`.*, `food_type`.*, `food_type`.`img` as `type_img`
                        FROM `food`
                        LEFT JOIN `food_type`
                        ON `food`.`food_type_id` = `food_type`.`food_type_id`
                        WHERE `food`.`res_id` = '$res_id' ");

                    while($row = mysqli_fetch_array($select)){
                        $msg = 'ต้องการลบเมนู '.$row['food_name'].' หรือไม่';
                        $target = confirm('food_manage.php', 'del_food', $row['food_id'], $msg);
                ?>
                    <tr valign="middle">
                        <td><?php echo $row['food_name'].$row['res_id'] ?></td>
                        <td>
                            <center>
                                <div class="rounded hover-img" style="width: 5rem; height: 5rem;">
                                    <img src="../upload/<?php echo $row['img'] ?>" class="img">
                                </div>
                            </center>
                        </td>
                        <td>
                            <?php if($row['discount'] != 0){ ?>
                                <s class="text-secondary">฿<?php echo $row['price'] ?></s>
                                <span class="text-success">฿<?php echo $row['new_price'] ?></span>
                                <span class="text-danger">(ลด <?php echo $row['discount'] ?>%)</span>
                            <?php } else { echo '฿'.$row['price']; } ?>
                        </td>
                        <td><?php echo $row['food_type'] ?></td>
                        <td>
                            <a href="food_edit.php?food_id=<?php echo $row['food_id'] ?>" class="btn btn-warning mb-2">แก้ไข</a>
                            <a href="food_discount.php?food_id=<?php echo $row['food_id'] ?>" class="btn btn-primary mb-2">ส่วนลด</a>
                            <!-- <a href="food_manage.php?del_food=<?php echo $row['food_id'] ?>" class="btn btn-danger mb-2" onclick="return confirm('ต้องการลบเมนู <?php echo $row['food_name'] ?> หรือไม่?')">ลบ</a> -->
                            <button class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#<?php echo $target ?>">ลบ</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>