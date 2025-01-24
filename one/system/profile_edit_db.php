<?php

    include_once '../db.php';
    if(isset($_POST['submit'])){
        $member = $_POST['member'];
        $member_id = $_POST['member_id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        include '../upload.php';

        $select = mysqli_query($conn, "SELECT * FROM `$member` WHERE `username` = '$username' AND `$member_id` != '".$_SESSION[$member_id]."' ");
        if($select -> num_rows > 0){
            alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่');
        } else {
            $sql = "UPDATE `$member` SET
            `full_name` = '$full_name',
            `username` = '$username',
            `address` = '$address',
            `phone` = '$phone' ";

            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)){
                $sql .= ", `img` = '$img' ";
            } 

            if($member == 'restaurant'){
                $res_name = $_POST['res_name'];
                $res_type = $_POST['res_type'];
                $sql .= ", `res_name` = '$res_name', `res_type` = '$res_type' ";
            }

            $sql = mysqli_query($conn, "$sql WHERE `$member_id` = '".$_SESSION[$member_id]."' ");
            echo ($sql ? alert('แก้ไขข้อมูลส่วนตัวสำเร็จ', '../'.$member.'/index.php?page=../template/profile') : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
        }
    }

?>