<?php

    include_once 'session.php';
    if(isset($_GET['star'])){
        $_SESSION['star'][$_GET['order_id']] = $_GET['star'];
        back();
    }

    if(isset($_POST['submit_review'])){
        $order_id = $_POST['order_id'];
        $res_id = $_POST['res_id'];
        $star = $_SESSION['star'][$_POST['order_id']];
        $review = $_POST['review'];

        $sql_order = mysqli_query($conn, "UPDATE `order_detail` SET `status` = 7, `star` = '$star', `review` = '$review' WHERE `order_id` = '$order_id' ");

        if($sql_order){
            $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '$res_id' ");
            $row_res = mysqli_fetch_array($select_res);
            
            $res_rating = $row_res['rating'] + $star;
            $res_qty = $row_res['qty_sale'] + 1;
            $res_star = ($res_rating / $res_qty);
            $res_star = number_format($res_star, 1);

            $sql_res = mysqli_query($conn, "UPDATE `restaurant` SET
            `star` = '$res_star',
            `rating` = '$res_rating',
            `qty_sale` = '$res_qty' WHERE `res_id` = '$res_id' ");

            if($sql_res){
                $select_food_order = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `order_id` = '$order_id' ");

                while($row_food_order = mysqli_fetch_array($select_food_order)){
                    // echo $row_food_order['food_id'].'</br>';

                    $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '".$row_food_order['food_id']."' ");
                    while($row_food = mysqli_fetch_array($select_food)){

                        $food_rating = $row_food['rating'] + $star;
                        $food_qty = $row_food['qty_sale'] + 1;
                        $food_star = ($food_rating / $food_qty);

                        // echo $row_food['food_id'].'</br>';
                        // echo $row_food['rating'].'</br>';
                        // echo $row_food['qty_sale'].'</br>';
                        // echo number_format($food_star, 1).'<hr>';
                        
                        $sql_food = mysqli_query($conn, "UPDATE `food` SET
                        `star` = '$food_star',
                        `rating` = '$food_rating',
                        `qty_sale` = '$food_qty' WHERE `food_id` = '".$row_food['food_id']."' ");
                    }
                }

                if($sql_food){
                    alert('รีวิวเสร็จสิ้น ขอบคุณที่ใช้บริการ', 'history.php');
                } else {
                    alert('เกิดข้อผิดพลาดในการรีวิว (3)');
                }
            } else {
                alert('เกิดข้อผิดพลาดในการรีวิว (2)');
            }
        } else {
            alert('เกิดข้อผิดพลาดในการรีวิว (1)');
        }
    }

?>