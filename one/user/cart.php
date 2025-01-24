<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้า</title>
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

        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '$see_res' AND `status` = 1 ");
        // *******
        if($select_res -> num_rows <= 0){
            header('location: index.php');
        }
        $row_res = mysqli_fetch_array($select_res);
    ?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <h2>ตะกร้า
                <button class="btn btn-primary float-end" onclick="window.history.back();">เลือกเมนูอาหารเพิ่ม</button>
            </h2>
            <div class="table-responsive mb-3">
                <table class="table table-striped table-hover table-bordered text-center shadow">
                    <tr>
                        <th>เมนูอาหาร</th>
                        <th>ราคาต่อชิ้น</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                        <th>จัดการ</th>
                    </tr>

                    <?php
                        $total_price = 0;
                        $all_price = 0;
                        if(isset($_SESSION['cpn_discount'])){
                            $cpn_discount = $_SESSION['cpn_discount'];
                        } else {
                            $cpn_discount = 0;
                        }
                        $sum_price = 0;
                        
                        foreach($_SESSION['cart_arr'][$see_res] as $food_id => $qty){
                            $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' ");
                            $row_food = mysqli_fetch_array($select_food);
                    ?>
                        <tr valign="middle">
                            <td>
                                <center>
                                    <div class="rounded hover-img" style="width: 5rem; height: 5rem;">
                                        <img src="../upload/<?php echo $row_food['img'] ?>" class="img">
                                    </div>
                                    <p><?php echo $row_food['food_name'] ?></p>
                                </center>
                            </td>
                            <td>
                                <?php  
                                    if($row_food['discount'] != 0){
                                        $price = $row_food['new_price'];
                                ?>
                                    <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                    <span class="text-success">฿<?php echo $row_food['new_price'] ?></span>
                                    <span class="text-danger">(ลด <?php echo $row_food['discount'] ?>%)</span>
                                <?php 
                                    } else {
                                        $price = $row_food['price'];
                                        echo '฿'.$price;
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="add_cart_db.php?food_id=<?php echo $row_food['food_id'].'&qty='.($qty-1) ?>" class="btn btn-warning">-</a>
                                <?php echo $qty ?>
                                <a href="add_cart_db.php?food_id=<?php echo $row_food['food_id'].'&qty='.($qty+1) ?>" class="btn btn-primary">+</a>
                            </td>
                            <td>฿
                                <?php 
                                    $total_price = $price * $qty;
                                    echo $total_price;
                                    $all_price += $total_price;
                                    $sum_price = $all_price;
                                ?>
                            </td>
                            <td>
                                <a href="add_cart_db.php?del_cart=<?php echo $food_id ?>" class="btn btn-warning" onclick="return confirm('ต้องการนำเมนู <?php echo $row_food['food_name'] ?> ออกจากตะกร้าหรือไม่?')">ลบ</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <hr>

            <div class="col-md-6">
                <form action="add_cart_db.php" class="d-flex gap-2 mb-4" method="post">
                    <input type="text" class="form-control" name="cpn_code" placeholder="กรอกโค้ดส่วนลด" requried>
                    <?php if($cpn_discount != 0){ ?>
                        <a href="add_cart_db.php?del_cpn" class="btn btn-warning">ลบ</a>
                    <?php } ?>
                    <input type="submit" class="btn btn-primary" name="add_cpn" value="ตกลง">
                </form>
                <h5>ค่าอาหาร<span class="float-end">฿<?php echo $all_price; ?></span></h5>

                <?php 
                    if($cpn_discount != 0){ 
                        $sum_price = discount($all_price, $cpn_discount);
                ?>
                    <h5 class="text-danger">ส่วนลด<span class="float-end">- <?php echo $cpn_discount ?>%</span></h5>
                    <h5 class="text-success mb-4">ค่าอาหาร<span class="float-end">฿<?php echo $sum_price ?></span></h5>
                <?php } ?>

                <form action="insert_order.php" method="post" enctype="multipart/form-data">
                    <p class="pb-0 mb-0 mt-3">การชำระเงิน</p>
                    <label for="cash" class="form-check-label rounded w-100 border mb-3 p-3" onclick="close_qr();">
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="payment" id="cash" value="cash" checked required>
                            <strong>เงินสด</strong>
                            <br>
                            ชำระเงินปลายทาง
                        </div>
                    </label>

                    <?php  
                        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '$see_res' ");
                        $row_res = mysqli_fetch_array($select_res);
                        if($row_res['bank'] != null){
                    ?>
                        <div class="accordion card">
                            <label for="tranfer" class="form-check-label rounded w-100 accordion-button" data-bs-toggle="collapse"
                            data-bs-target="#qr_code" id="test" onclick="open_qr();">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="payment" id="tranfer" value="tranfer" required>
                                    <strong>ชำระทันที</strong>
                                    <br>
                                    โอนจ่าย
                                </div>
                            </label>

                            <div class="collapse accordion-collapse" id="qr_code">
                                <div class="accordion-body">
                                    <div class="d-flex gap-2">
                                        <div>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#qr_zoom">
                                                <div class="hover-img border" style="aspect-ratio: 1/1; width: 7rem;">
                                                    <div class="w-100 h-100" style="cursor: pointer;">
                                                        <img src="../upload/<?php echo $row_res['qr_code'] ?>" class="img">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div>
                                            <p>ธนาคาร : <?php echo $row_res['bank'] ?></p>
                                            <p>เลขบัญชี : <?php echo $row_res['ac_num'] ?></p>
                                            <p>ชื่อบัญชี : <?php echo $row_res['ac_name'] ?></p>
                                        </div>
                                    </div>
                                    <input type="file" name="img" id="slip">
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="qr_zoom">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">แสกน QR Code</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <img src="../upload/<?php echo $row_res['qr_code'] ?>" class="img">
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <hr class="my-5">

                    <div class="card shadow p-3">
                        <h2 class="text-center mb-3">ยืนยันข้อมูลผู้สั่ง</h2>
                        <input type="hidden" name="all_price" value="<?php echo $all_price ?>">
                        <input type="hidden" name="cpn_discount" value="<?php echo $cpn_discount ?>">
                        <input type="hidden" name="sum_price" value="<?php echo $sum_price ?>">

                        <label for="">ชื่อ - สกุล</label>
                        <input type="text" class="form-control mb-3" name="full_name" value="<?php echo $row['full_name'] ?>" reqiored>

                        <label for="">ที่อยู่</label>
                        <input type="text" class="form-control mb-3" name="address" value="<?php echo $row['address'] ?>" required>

                        <label for="">เบอร์โทร</label>
                        <input type="phone" class="form-control mb-3" name="phone" value="<?php echo $row['phone'] ?>" required>

                        <input type="submit" class="btn btn-success w-100" name="buy_order" value="สั่งเลย">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../function.js"></script>
</body>
</html>