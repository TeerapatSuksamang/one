<?php
    while($row = mysqli_fetch_array($select)){
        if(!isset($_SESSION['star'][$row['order_id']])){
            $_SESSION['star'][$row['order_id']] = 1;
        }
        $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$row['res_id']."' ");
        $row_res = mysqli_fetch_array($select_res);
?>
    <span class="position-absolute mb-5" id="<?php echo $row['order_id'] ?>"></span>
    <div class="col-md-10 border rounded shadow p-3 mb-5">
        <div class="row">
            <div class="col-md-6">
                <h3>คำสั่งซื้อร้าน : <?php echo $row_res['res_name'] ?></h3>
                <h5><?php echo $row_res['address'] ?> | <?php echo $row_res['phone'] ?></h5>
            </div>
            <div class="col-md-6">
                <?php if($member == 'user' && $row['status'] <= 0){ ?>
                    <div class="form-control p-2">
                        <h4 class="text-danger">ออร์เดอร์ของคุณถูกยกเลิก</h4>
                        <?php if($row['status'] == 0){ ?>
                            <a href="../system/update_status.php?status=-1&order_id=<?php echo $row['order_id'] ?>" class="btn btn-outline-primary w-100">
                                รับทราบ
                            </a>
                        <?php } ?>
                    </div>
                <?php } else if($member == 'restaurant' && $row['status'] == 1) { ?>
                    <div class="border rounded d-flex gap-3 p-2" data-bs-toggle="modal" data-bs-target="#open_slip" style="cursor: pointer;">
                        <div class="hover-img rounded" style="aspect-ratio: 1/1; width: 7rem;">
                            <img src="../upload/<?php echo $row['slip'] ?>" class="img" style="">
                        </div>
                        <h5 class="text-danger align-items-center d-flex">ตรวจสอบ และยืนยันสลิปถูกต้อง👆</h5>
                    </div>

                    <form action="" class="modal fade" id="open_slip">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-tile">เช็คสลิป</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss=""></button>
                                </div>
                                <img src="../upload/<?php echo $row['slip'] ?>" class="img">
                                <div class="modal-footer">
                                    <a href="../system/update_status.php?status=0&order_id=<?php echo $row['order_id'] ?>" class="btn btn-outline-danger">ยกเลิกออร์เดอร์</a>
                                    <a href="../system/update_status.php?status=2&order_id=<?php echo $row['order_id'] ?>" class="btn btn-success">ยืนยันสลิปถูกต้อง</a>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } else if($member == 'rider' && $row['status'] == 2) { ?>
                    <a href="../system/update_status.php?status=3&order_id=<?php echo $row['order_id'] ?>" class="btn btn-outline-primary float-end">รับออร์เดอร์เลย!</a>
                <?php } else if($member == 'restaurant' && $row['status'] == 3) { ?>
                    <a href="../system/update_status.php?status=4&order_id=<?php echo $row['order_id'] ?>" class="btn btn-outline-primary float-end">ยืนยันการทำอาหารเสร็จสิ้น</a>
                <?php } else if($member == 'rider' && $row['status'] == 4) { ?>
                    <a href="../system/update_status.php?status=5&order_id=<?php echo $row['order_id'] ?>" class="btn btn-outline-success float-end">อาหารเสร็จแล้ว จัดส่งเลย!</a>
                <?php } else if($member == 'rider' && $row['status'] == 5) { ?>
                    <a href="../system/update_status.php?status=6&order_id=<?php echo $row['order_id'] ?>" class="btn btn-outline-success float-end">ยืนยันการจัดส่งและชำระเงินเสร็จสิ้น</a>
                <?php } else if($member == 'user' && $row['status'] == 6) { ?>
                    <form action="order_review.php" class="form-control p-2" method="post">
                        <h6>อร่อยมั้ยครับบ</h6>
                        <div class="d-block">
                            <a href="order_review.php?star=1&order_id=<?php echo $row['order_id'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row['order_id']] > 0 ? 3 : 4) ?></h2></a>
                            <a href="order_review.php?star=2&order_id=<?php echo $row['order_id'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row['order_id']] > 1 ? 3 : 4) ?></h2></a>
                            <a href="order_review.php?star=3&order_id=<?php echo $row['order_id'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row['order_id']] > 2 ? 3 : 4) ?></h2></a>
                            <a href="order_review.php?star=4&order_id=<?php echo $row['order_id'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row['order_id']] > 3 ? 3 : 4) ?></h2></a>
                            <a href="order_review.php?star=5&order_id=<?php echo $row['order_id'] ?>" class="btn text-warning st"><h2>&#973<?php echo ($_SESSION['star'][$row['order_id']] > 4 ? 3 : 4) ?></h2></a>
                        </div>
                        <div class="d-flex gap-2">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                            <input type="hidden" name="res_id" value="<?php echo $row['res_id'] ?>">
                            <input type="text" class="form-control" name="review" placeholder="อาหารมื้อนี้เป็นอย่างไรบ้าง" required>
                            <input type="submit" class="btn btn-primary" name="submit_review" value="ยืนยัน">
                        </div>
                    </form>
                <?php } else if($row['status'] == 7) { ?>
                    <form action="order_review.php" class="form-control p-2" method="post">
                        <h6>คะแนนรีวิว
                            <span class="float-end"><?php echo $row['date'] ?> | <?php echo $row['time'] ?></span>
                        </h6>
                        <h3 class="text-warning">
                            <?php star2($row['star']) ?>
                        </h3>
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" name="review" value="<?php echo $row['review'] ?>" readonly>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>รูปภาพ</th>
                                <th>เมนูอาหาร</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $select_food = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_id` = '".$row['order_id']."' ");
                                while($row_food = mysqli_fetch_array($select_food)){
                            ?>
                                <tr>
                                    <td>
                                        <div class="rounded hover-img" style="width: 5rem; height: 5rem;">
                                            <img src="../upload/<?php echo $row_food['img'] ?>" class="img">
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row_food['food_name'] ?>
                                        <br>
                                        <?php if($row_food['new_price'] != 0){ ?>
                                            <s class="text-secondary">฿<?php echo $row_food['price'] ?></s>
                                            <span class="text-success">฿<?php echo $row_food['new_price'] ?></span>
                                        <?php } else { echo '฿'.$row_food['price']; } ?>
                                    </td>
                                    <td><?php echo $row_food['qty'] ?></td>
                                    <td>฿<?php echo $row_food['total_price'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-control p-2 mb-4">
                    <h3 class="text-center mb-3">ข้อมูลผู้สั่ง</h3>
                    <h5>ชื่อผู้สั่ง : <?php echo $row['full_name'] ?></h5>
                    <h5>ที่อยู่ : <?php echo $row['address'] ?></h5>
                    <h5>เบอร์โทร : <?php echo $row['phone'] ?></h5>
                </div>

                <h5>สถานะออร์เดอร์</h5>
                <progress class="progress w-100 mb-2" value="<?php echo $row['status'] ?>" max="6"></progress>
                <h6 class="mb-4">
                    <?php if($row['status'] == 0){ ?>
                        คำสั่งซื้อถูกยกเลิก
                    <?php } else if($row['status'] == 1){ ?>
                        รอร้านอาหารยืนยันออร์เดอร์
                    <?php } else if($row['status'] == 2){ ?>
                        กำลังค้นหาไรเดอร์
                    <?php } else if($row['status'] == 3){ ?>
                        เจอไรเดอร์แล้ว ร้านค้ากำลังทำอาหาร
                    <?php } else if($row['status'] == 4){ ?>
                        ร้านค้าทำอาหารเสร็จสิ้น
                    <?php } else if($row['status'] == 5){ ?>
                        รอสักครู่ ไรเดอร์กำลังจัดส่งอาหาร
                    <?php } else if($row['status'] == 6){ ?>
                        การจัดส่งและชำระเงินเสร็จสิ้น
                    <?php } else if($row['status'] == 7){ ?>
                        เสร็จสิ้น
                    <?php } ?>
                </h6>

                <h5>ค่าอาหาร<span class="float-end">฿<?php echo $row['all_price'] ?></span></h5>
                
                <?php if($row['cpn_discount'] != 0){ ?>
                    <h5 class="text-danger">ส่วนลด<span class="float-end">- <?php echo $row['cpn_discount'] ?>%</span></h5>
                    <h5 class="text-success">ค่าอาหาร<span class="float-end">฿<?php echo $row['sum_price'] ?></span></h5>
                <?php } ?>
                <h5>การชำระเงิน<span class="float-end"><?php echo ($row['slip'] != 0 ? 'โอนจ่าย' : 'เงินสด') ?></span></h5>
            </div>
        </div>
        <?php if($member == 'restaurant'){ ?>
            <a href="report_pdf.php?order_id=<?php echo $row['order_id'] ?>" class="btn btn-outline-primary w-100">ดูใบเสร็จ</a>
        <?php } ?>
    </div>
<?php } ?>