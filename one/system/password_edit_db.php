<?php

    include_once '../db.php';
    if(isset($_POST['submit'])){
        $password = $_POST['password'];
        $old_pass = $_POST['old_pass'];
        $new_pass = password_hash($_POST['new_pass'], PASSWORD_BCRYPT);
        $member = $_POST['member'];
        $member_id = $_POST['member_id'];

        if(password_verify($old_pass, $password)){
            $sql = mysqli_query($conn, "UPDATE `$member` SET `password` = '$new_pass' WHERE `$member_id` = '".$_SESSION[$member_id]."' ");
            echo ($sql ? alert('แก้ไขรหัสผ่านสำเร็จ', '../'.$member.'/index.php?page=../template/profile') : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
        } else {
            alert('รหัสผ่านเก่าไม่ถูกต้อง');
        }
    }

?>