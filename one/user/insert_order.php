<?php

    include_once 'session.php';
    if(isset($_POST['buy_order'])){
        $res_id = $_SESSION['see_res'];
        $user_id = $_SESSION['user_id'];

        $all_price = $_POST['all_price'];
        $cpn_discount = $_POST['cpn_discount'];
        $sum_price = $_POST['sum_price'];
        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        date_default_timezone_set("Asia/Bangkok");
        $date = date('Y-m-d');
        $time = date("H:i:s");

        
        if($sum_price != 0){
            if(isset($_FILES['img']['name'])){
                include '../upload.php';
                if(move_uploaded_file($_FILES['img']['tmp_name'], $path)){
                    $sql_order = mysqli_query($conn, "INSERT INTO `order_detail`(`res_id`, `all_price`, `cpn_discount`, `sum_price`, `user_id`, `full_name`, `address`, `phone`, `slip` , `date`, `time`)
                    VALUES('$res_id', '$all_price', '$cpn_discount', '$sum_price', '$user_id', '$full_name', '$address', '$phone', '$img', '$date', '$time' ) ");
                } else {
                    // alert('เกิดข้อผิดพลาดในการอัพโหลดสลิป');
                    echo 'slip 0';
                    $sql_order = mysqli_query($conn, "INSERT INTO `order_detail`(`res_id`, `all_price`, `cpn_discount`, `sum_price`, `user_id`, `full_name`, `address`, `phone`, `date`, `time`, `status`)
                    VALUES('$res_id', '$all_price', '$cpn_discount', '$sum_price', '$user_id', '$full_name', '$address', '$phone', '$date', '$time', 2 ) ");
                }
            } else {
                $sql_order = mysqli_query($conn, "INSERT INTO `order_detail`(`res_id`, `all_price`, `cpn_discount`, `sum_price`, `user_id`, `full_name`, `address`, `phone`, `date`, `time`, `status`)
                VALUES('$res_id', '$all_price', '$cpn_discount', '$sum_price', '$user_id', '$full_name', '$address', '$phone', '$date', '$time', 2 ) ");
            }
            $order_id = mysqli_insert_id($conn);

            if($sql_order){
                foreach($_SESSION['cart_arr'][$res_id] as $food_id => $qty){
                    $select = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '$food_id' ");
                    $row = mysqli_fetch_array($select);

                    if($row['discount'] != 0){
                        $price = $row['new_price'];
                    } else {
                        $price = $row['price'];
                    }

                    $sql_food = mysqli_query($conn, "INSERT INTO `food_order`(`order_id`, `food_id`, `food_name`, `img`, `price`, `new_price`, `qty`, `total_price`)
                    VALUES('$order_id', '$food_id', '".$row['food_name']."', '".$row['img']."', '".$row['price']."', '".$row['new_price']."', '$qty', '".$qty * $price ."') ");

                    if($sql_food){
                        unset($_SESSION['cart_arr'][$res_id]);
                        alert('สั่งซื้อสำเร็จ รอออร์เดอร์ของคุณสักครู่', 'status.php');
                    } else {
                        alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง (2)');
                    }
                }
            } else {
                alert('ขออภัย เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้้งในภายหลัง (1)');
            }
        } else { 
            alert('ยังไม่มีสินค้าในตะกร้า เลือกดูเมนูที่ชอบเลย', 'see_res.php');
        }
    }

?>