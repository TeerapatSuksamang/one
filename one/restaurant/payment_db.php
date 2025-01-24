<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $bank = $_POST['bank'];
        $ac_num = $_POST['ac_num'];
        $ac_name = $_POST['ac_name'];

        include '../upload.php';

        if(move_uploaded_file($_FILES['img']['tmp_name'], $path)){
            $sql = mysqli_query($conn, "UPDATE `restaurant` SET
            `qr_code` = '$img',
            `bank` = '$bank',
            `ac_num` = '$ac_num',
            `ac_name` = '$ac_name' WHERE `res_id` = '".$_SESSION['res_id']."' ");
        } else {
            $sql = mysqli_query($conn, "UPDATE `restaurant` SET
            `bank` = '$bank',
            `ac_num` = '$ac_num',
            `ac_name` = '$ac_name' WHERE `res_id` = '".$_SESSION['res_id']."' ");
        }
        ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้งในภายหลัง'));
    }

?>