<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
    <?php
        include_once 'db.php';
        // if(isset($_SESSION['alert'])){
        //     echo "<script>window.location.reload();</script>";
        // }
        $member = ($_GET['member'] ?: '');
        if(!in_array($member, ['admin', 'user', 'rider', 'restaurant'])){
            header('location: index.php');
        }
    ?>
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6 card shadow p-0">
                <ul class="nav nav-tabs bg-light">
                    <li class="nav-item">
                        <a href="register.php?member=user" class="nav-link <?php echo ($member == 'user' ? 'active' : '') ?>">User</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php?member=restaurant" class="nav-link <?php echo ($member == 'restaurant' ? 'active' : '') ?>">Restaurant</a>
                    </li>
                    <li class="nav-item">
                        <a href="register.php?member=rider" class="nav-link <?php echo ($member == 'rider' ? 'active' : '') ?>">Rider</a>
                    </li>
                </ul>

                <form action="system/register_db.php" class="p-3" method="post" enctype="multipart/form-data">
                    <h1 class="text-center mb-4"><?php echo ucfirst($member) ?> Register</h1>
                    <input type="hidden" name="member" value="<?php echo $member ?>">

                    <center>
                        <div class="rounded-circle hover-img border mb-2" style="width: 7rem; height: 7rem;">
                            <img src="upload/df.png" class="img" id="preview">
                        </div>
                        <input type="file" name="img" id="img_upload" hidden>
                        <label for="img_upload" class="btn btn-outline-primary mb-4">เพิ่มรูปโปรไฟล์</label>
                    </center>

                    <?php if($member == 'restaurant'){ ?>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="res_name" id="" placeholder="" required>
                            <label for="">ชื่อร้านอาหาร</label>
                        </div>
                    <?php } ?>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" name="full_name" id="" placeholder="" required>
                        <label for="">ชื่อ - นามสกุล</label>
                    </div>

                    <!-- ***** -->
                    <div class="form-floating mb-4 <?php echo (isset($alert) ? 'alert alert-danger' : '') ?>">
                        <input type="text" class="form-control" name="username" id="username" placeholder="" required>
                        <label for="">ชื่อผู้ใช้ <?php echo ($alert ?? '') ?></label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" name="password" id="" placeholder="" required>
                        <label for="">รหัสผ่าน</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" name="address" id="" placeholder="" required>
                        <label for="">ที่อยู่</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="phone" class="form-control" name="phone" id="" placeholder="" required>
                        <label for="">เบอร์โทรศัพท์</label>
                    </div>

                    <?php if($member == 'restaurant'){ ?>
                        <label for="">ประเภทร้านอาหาร</label>
                        <select name="res_type" class="form-select mb-4">
                            <?php
                                include_once '../db.php';
                                $select = mysqli_query($conn, "SELECT * FROM `restaurant_type` ");
                                while($row = mysqli_fetch_array($select)){
                            ?>
                                <option value="<?php echo $row['res_type'] ?>"><?php echo $row['res_type'] ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>

                    <div class="d-flex gap-3">
                        <a href="index.php" class="btn btn-outline-danger w-100">ย้อนกลับ</a>
                        <input type="submit" class="btn btn-success w-100" name="submit" value="ยืนยัน">
                    </div>

                    <p class="text-center my-3">มีบัญชีแล้ว?<a href="login.php?member=<?php echo $member ?>">ลงชื่อเข้าใช้</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="function.js"></script>
</body>
</html>