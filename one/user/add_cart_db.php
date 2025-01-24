<?php

    include_once 'session.php';
    if(isset($_POST['add_cart'])){
        $_SESSION['cart_arr'][$_SESSION['see_res']][$_POST['food_id']] = $_POST['qty'];
        back();
    }
    
    if(isset($_GET['del_cart'])){
        unset($_SESSION['cart_arr'][$_SESSION['see_res']][$_GET['del_cart']]);
        back();
    }

    if(isset($_GET['set'])){
        unset($_SESSION['cart_arr']);
    }

    if(isset($_GET['qty'])){
        echo $_GET['qty'];
        echo $_GET['food_id'];
        if($_GET['qty'] > 0){
            // $_SESSION['cart_arr'][$_SESSION['see_res']][$_GET['food_id']] = [$_GET['qty']];
            $_SESSION['cart_arr'][$_SESSION['see_res']][$_GET['food_id']] = $_GET['qty'];
        }
        back();
    }

    if(isset($_POST['add_cpn'])){
        $cpn_code = $_POST['cpn_code'];

        $select = mysqli_query($conn, "SELECT * FROM `coupon` WHERE `cpn_code` = '$cpn_code' ");
        if($select -> num_rows > 0){
            $row = mysqli_fetch_array($select);
            $_SESSION['cpn_discount'] = $row['cpn_discount'];
            back();
        } else {
            unset($_SESSION['cpn_discount']);
            alert('คูปองส่วนลดไม่ถูกต้อง');
        }
    }

    if(isset($_GET['del_cpn'])){
        unset($_SESSION['cpn_discount']);
        back();
    }

?>