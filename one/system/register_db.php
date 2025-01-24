<?php

    include_once '../db.php';
    if(isset($_POST['submit'])){
        $member = $_POST['member'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        include '../upload.php';

        $select = mysqli_query($conn, "SELECT * FROM `$member` WHERE `username` = '$username' ");

        if($select -> num_rows > 0){
            alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่');
        } else {
            $c = "`full_name`, `username`, `password`, `address`, `phone` ";
            $v = "'$full_name', '$username', '$password', '$address', '$phone' ";

            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)){
                $c .= ", `img` ";
                $v .= ", '$img' ";
            }

            if($member == 'restaurant'){
                $res_name = $_POST['res_name'];
                $res_type = $_POST['res_type'];
                $c .= ", `res_name`, `res_type` ";
                $v .= ", '$res_name', '$res_type' ";
            }

            $sql = mysqli_query($conn, "INSERT INTO `$member`($c) VALUES($v) ");
            // $sql = mysqli_query($conn, "INSERT INTO `$member`($c) VALUES($v) ");
            // echo "INSERT INTO `$member`($c) VALUES($v)";
            echo ($sql ? alert('สมัครใช้งานสำเร็จ รออนุมัติการใช้งาน', '../login.php?member='.$member) : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
        }
    }

?>