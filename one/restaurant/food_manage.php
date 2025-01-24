<?php

    include_once 'session.php';
    $res_id = $_SESSION['res_id'];

    if(isset($_POST['add_food_type'])){
        $food_type = $_POST['food_type'];
        include '../upload.php';

        $select = mysqli_query($conn, "SELECT * FROM `food_type` WHERE `food_type` = '$food_type' AND `res_id` = '$res_id' ");
        if($select -> num_rows > 0){
            alert('มีหมวดหมู่อาหารนี้ในร้านแล้ว');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)){
                $sql = mysqli_query($conn, "INSERT INTO `food_type`(`food_type`, `img`, `res_id`) VALUES('$food_type', '$img', '$res_id') ");
                echo ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
            } else {
                alert('เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ');
            }
        }
    }

    if(isset($_GET['del_type'])){
        $sql = mysqli_query($conn, "DELETE FROM `food_type` WHERE `food_type_id` = '".$_GET['del_type']."' ");
        echo ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
    }

    if(isset($_POST['add_food'])){
        $food_name = $_POST['food_name'];
        $price = $_POST['price'];
        $food_type = $_POST['food_type'];
        include '../upload.php';

        $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_name` = '$food_name' AND `res_id` = '$res_id' ");
        if($select -> num_rows > 0){
            alert('มีเมนูอาหารนี้ในร้านแล้ว');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)){
                $sql = mysqli_query($conn, "INSERT INTO `food`(`food_name`, `img`, `price`, `food_type`, `res_id`) VALUES('$food_name', '$img', '$price', '$food_type', '$res_id') ");
                echo ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
            } else {
                alert('เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ');
            }
        }
    }

    if(isset($_POST['food_edit'])){
        $food_id = $_POST['food_id'];
        $food_name = $_POST['food_name'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $new_price = ($discount != 0 ? discount($price, $discount) : 0);
        $food_type = $_POST['food_type'];
        include '../upload.php';
        
        $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_name` = '$food_name' AND `food_id` != '$food_id' AND `res_id` = '$res_id' ");
        if($select -> num_rows > 0){
            alert('ชื่อเมนูอาหารซ้ำกับในร้าน กรุณาเปลี่ยนใหม่');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)){
                $sql = mysqli_query($conn, "UPDATE `food` SET 
                `food_name` = '$food_name',
                `img` = '$img',
                `price` = '$price',
                `discount` = '$discount',
                `new_price` = '$new_price',
                `food_type` = '$food_type' WHERE `food_id` = '$food_id' ");
            } else {
                $sql = mysqli_query($conn, "UPDATE `food` SET 
                `food_name` = '$food_name',
                `price` = '$price',
                `discount` = '$discount',
                `new_price` = '$new_price',
                `food_type` = '$food_type' WHERE `food_id` = '$food_id' ");
            }

            ($sql ? alert('แก้ไขเมนูอาหารสำเร็จ', 'index.php') : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
        }
    }

    if(isset($_POST['food_discount'])){
        $food_id = $_POST['food_id'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $new_price = ($discount != 0 ? discount($price, $discount) : 0);

        $sql = mysqli_query($conn, "UPDATE `food` SET `discount` = '$discount', `new_price` = '$new_price' WHERE `food_id` = '$food_id' ");
        echo ($sql ? alert('แก้ไขส่วนลดสำเร็จ', 'index.php') : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
    }

    if(isset($_GET['del_food'])){
        $sql = mysqli_query($conn, "DELETE FROM `food` WHERE `food_id` = '".$_GET['del_food']."' ");
        echo ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
    }

?>