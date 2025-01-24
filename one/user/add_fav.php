<?php

    include_once 'nav.php';
    include_once '../template/load.php';
    $user_id = $_SESSION['user_id'];

    if(isset($_GET['fav'])){
        $sql = mysqli_query($conn, "INSERT INTO `favorite`(`user_id`, `res_id`) VALUES('$user_id', '".$_GET['fav']."') ");
        ($sql ? alert('เพิ่มร้านไปยังรายการโปรดแล้ว') : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
    }

    if(isset($_GET['un_fav'])){
        $sql = mysqli_query($conn, "DELETE FROM `favorite` WHERE `fav_id` = '".$_GET['un_fav']."' ");
        ($sql ? alert('นำออกรายการโปรดแล้ว') : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
    }

?>
