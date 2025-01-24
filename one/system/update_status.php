<?php

    include_once '../db.php';
    if(isset($_GET['status'])){
        if($_GET['status'] == 3){
            $sql = mysqli_query($conn, "UPDATE `order_detail` SET `status` = '".$_GET['status']."', `rider_id` = '".$_SESSION['rider_id']."' WHERE `order_id` = '".$_GET['order_id']."' ");
            ($sql ? alert('รับออร์เดอร์แล้ว รอรับเมนูอาหารที่ร้านได้เลย', '../rider/status.php') : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
        } else {
            $sql = mysqli_query($conn, "UPDATE `order_detail` SET `status` = '".$_GET['status']."' WHERE `order_id` = '".$_GET['order_id']."' ");
            ($sql ? alert('อัพเดทสถานะสำเร็จ') : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
        }
    }

?>