<link rel="stylesheet" href="../style/style.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../bootstrap/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background: #252525;">
    <div class="container-fluid">
        <?php
            include_once '../db.php';
            if(isset($_SESSION['user_id'])){
                $select = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '".$_SESSION['user_id']."' ");
                $row = mysqli_fetch_array($select);
            }
        ?>
        <a href="index.php?page=../template/profile" class="pro-brand">
            <img src="../upload/<?php echo (isset($_SESSION['user_id']) ? $row['img'] : 'df.png') ?>" class="img">
        </a>
        <a href="" class="navbar-brand"><?php echo $web['web_name'] ?></a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#hamburger">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="hamburger">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <hr class="text-light">
                <li class="nav-item">
                    <a href="index.php?page=home" class="nav-link <?php echo ($_GET['page'] == 'home' ? 'active' : '') ?>">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a href="status.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'status.php' ? 'active' : '') ?>">สถานะการสั่งซื้อ</a>
                </li>
                <li class="nav-item">
                    <a href="history.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'history.php' ? 'active' : '') ?>">ประวัติการสั่งซื้อ</a>
                </li>
                <li class="nav-item">
                    <a href="fav.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'fav.php' ? 'active' : '') ?>">ร้านโปรด</a>
                </li>

                <!-- <li class="nav-item">
                    <a href="message.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'message.php' ? 'active' : '') ?>">
                        <span class="position-relative ">
                            ข้อความ
                            <?php   
                                $un = mysqli_query($conn, "SELECT * FROM `message` WHERE `member` = 'user' AND `member_id` = '".$_SESSION['user_id']."' AND `status` = 0 ");
                                if($un -> num_rows > 0){ 
                            ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $un -> num_rows ?></span>
                            <?php } ?>
                        </span>
                    </a>
                </li> -->

                <hr class="text-light">
                <?php if(!isset($_SESSION['user_id'])){ ?>
                    <a href="../login.php?member=user" class="btn btn-success">ลงชื่อเข้าใช้</a>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>