<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการเว็บไซต์</title>
</head>
<body>
    <?php
    
        include_once 'nav.php';
    
    ?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="card shadow p-3">
                    <h2>ชื่อเว็บไซต์</h2>
                    <hr>
                    <form action="web_manage_db.php" class="d-flex gap-2" method="post">
                        <input type="text" class="form-control" name="web_name" value="<?php echo $web['web_name'] ?>" required>
                        <input type="submit" class="btn btn-secondary" name="web_edit" value="🖊">
                    </form>
                    <hr>
                    <h4>เพิ่มคูปองส่วนลด</h4>
                    <form action="web_manage_db.php" class="d-flex gap-2 mb-3" method="post">
                        <input type="text" class="form-control" name="cpn_code" placeholder="คูปองส่วนลด" required>
                        <input type="number" min="1" max="99" class="form-control" name="cpn_discount" placeholder="เปอร์เซ็นที่ลด" required>
                        <input type="submit" class="btn btn-primary" name="add_cpn" value="ตกลง">
                    </form>

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>คูปองส่วนลด</th>
                                    <th>เปอร์เซ็นที่ลด</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $select_cpn = mysqli_query($conn, "SELECT * FROM `coupon` ");
                                    while($row_cpn = mysqli_fetch_array($select_cpn)){
                                ?>
                                    <tr>
                                        <td><?php echo $row_cpn['cpn_code'] ?></td>
                                        <td><?php echo $row_cpn['cpn_discount'] ?></td>
                                        <td>
                                            <a href="web_manage_db.php?del_cpn=<?php echo $row_cpn['cpn_id'] ?>" class="btn text-danger fw-bold" onclick="return confirm('ต้องการลบคูปองนี้หรือไม่?')">ลบ</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>