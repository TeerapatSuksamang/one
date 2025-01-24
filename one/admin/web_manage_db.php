<?php

    include_once 'session.php';
    if(isset($_POST['web_edit'])){
        $sql = mysqli_query($conn, "UPDATE `admin` SET `web_name` = '".$_POST['web_name']."' ");
        ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
    }

    if(isset($_POST['add_cpn'])){
        $cpn_code = $_POST['cpn_code'];
        $cpn_discount = $_POST['cpn_discount'];

        $select = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `cpn_code` = '$cpn_code' ");
        if($select -> num_rows > 0){
            alert('ชื่อคูปองส่วนลดซ้ำ กรุณาเปลี่ยนใหม่');
        } else {
            $sql = mysqli_query($conn, "INSERT INTO `coupon`(`cpn_code`, `cpn_discount`) VALUES('$cpn_code', '$cpn_discount') ");
            ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
        }
    }

    if(isset($_GET['del_cpn'])){
        $sql = mysqli_query($conn, "DELETE FROM `coupon` WHERE `cpn_id` = '".$_GET['del_cpn']."' ");
        ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
    }

?>