<link rel="stylesheet" href="../style/style.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../bootstrap/js/bootstrap.min.js"></script>

<nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background: #594545;">
    <div class="container-fluid">
        <?php
            include_once 'session.php';
            $select = mysqli_query($conn, "SELECT * FROM `rider` WHERE `rider_id` = '".$_SESSION['rider_id']."' ");
            $row = mysqli_fetch_array($select);
        ?>
        <a href="index.php?page=../template/profile" class="pro-brand">
            <img src="../upload/<?php echo $row['img'] ?>" class="img">
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
                    <a href="order.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'order.php' ? 'active' : '') ?>">รับออร์เดอร์</a>
                </li>
                <li class="nav-item">
                    <a href="status.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'status.php' ? 'active' : '') ?>">สถานะการจัดส่ง</a>
                </li>
                <li class="nav-item">
                    <a href="history.php" class="nav-link <?php echo (basename($_SERVER['SCRIPT_NAME']) == 'history.php' ? 'active' : '') ?>">ประวัติการจัดส่ง</a>
                </li>
            </ul>
        </div>
    </div>
</nav>