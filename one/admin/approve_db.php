<?php

    include_once 'session.php';
    if(isset($_POST['add_res_type'])){
        $res_type = $_POST['res_type'];
        include '../upload.php';

        $select = mysqli_query($conn, "SELECT * FROM `restaurant_type` WHERE `res_type` = '$res_type' ");
        if($select -> num_rows > 0){
            alert('มีประเภทร้านอาหารนี้แล้ว');
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)){
                $sql = mysqli_query($conn, "INSERT INTO `restaurant_type`(`res_type`, `img`) VALUES('$res_type', '$img') ");
                // echo ("INSERT INTO `restaurant_type`(`res_type`, `img`) VALUES('$res_type', '$img')");
                echo ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
            } else {
                alert('เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ');
            }
        }
    }

    if(isset($_REQUEST['permis'])){
        $permis = $_REQUEST['permis'];
        $permis_id = $_REQUEST['permis_id'];
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        $note = ($_REQUEST['note'] ?? '');

        // echo $permis.'</br>';
        // echo $permis_id.'</br>';
        // echo $id.'</br>';
        // echo $status.'</br>';
        // echo $note.'</br>';

        // echo $status.'</br>';
        // echo "UPDATE `$permis` SET `status` = '$status' WHERE `$permis_id` = '$id' ";
        $sql = mysqli_query($conn, "UPDATE `$permis` SET `status` = '$status', `note` = '$note' WHERE `$permis_id` = '$id' ");
        // echo "UPDATE `$permis` SET `status` = '$status' WHERE `$permis_id` = '$id' ";
        echo ($sql ? back() : alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง'));
    }

?>