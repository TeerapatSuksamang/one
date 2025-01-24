<link rel="stylesheet" href="../style/style.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../bootstrap/js/bootstrap.bundle.js"></script>

<?php
    include_once 'session.php';
?>
<nav class="navbar navbar-expand-md navbar-dark sticky-top" style="background: #27374D;">
    <div class="container-fluid">
        <?php
            $select = mysqli_query($conn, "SELECT * FROM `admin` WHERE `admin_id` = '".$_SESSION['admin_id']."' ");
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
                    <a href="index.php?page=web_manage" class="nav-link <?php echo ($_GET['page'] == 'web_manage' ? 'active' : '') ?>">จัดการเว็บไซต์</a>
                </li>
                <li class="nav-item">
                    <a href="approve.php?permis=restaurant" class="nav-link <?php echo ($_GET['permis'] == 'restaurant' ? 'active' : '') ?>">อนุมัติร้านอาหาร</a>
                </li>
                <li class="nav-item">
                    <a href="approve.php?permis=rider" class="nav-link <?php echo ($_GET['permis'] == 'rider' ? 'active' : '') ?>">อนุมัติผู้ส่งอาหาร</a>
                </li>
                <li class="nav-item">
                    <a href="approve.php?permis=user" class="nav-link <?php echo ($_GET['permis'] == 'user' ? 'active' : '') ?>">อนุมัติผู้ใช้งาน</a>
                </li>
            </ul>
        </div>
    </div>
</nav>