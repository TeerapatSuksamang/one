<?php

    ini_set("display_errors", 1);
    // error_reporting(0);
    session_start();

    $conn = mysqli_connect('localhost', 'root', '', 'one');
    // $conn = mysqli_connect('localhost', 'ietdevco_krujune', 'qwerty', 'ietdevco_krujune');
    // $conn = mysqli_connect('localhost', 'team1', 'PbVQB', 'team1');
    // echo ($conn ? 1 : 0);

    $select_web = mysqli_query($conn, "SELECT * FROM `admin` ORDER BY `admin_id` ASC LIMIT 1 ");
    $web = mysqli_fetch_array($select_web);

    if(isset($_SESSION['alert'])){
        include_once 'template/alert.php';
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']);
    }

    function alert($msg, $lo = '', $name = ''){
        $_SESSION['alert'] = $msg; 
        if($lo == ''){
            echo "<script>window.history.back()</script>";
            // echo "<script>alert('$msg'); window.history.back();</script>";
        } else {
            echo "<script>window.location = '$lo';</script>";
            // echo "<script>alert('$msg'); window.location = '$lo';</script>";
        }

        $_SESSION['form'] = $name;
    }
    
    function form($name){
        if(isset($_SESSION['form'])){
            if($_SESSION['form'] == $name){
                echo 'alert alert-danger';
            }
            unset($_SESSION['form']);
        }
    }

    function back(){
        echo "<script>window.history.back();</script>";
    }

    function discount($price, $discount){
        $new = ($price * $discount) / 100;
        $new_price = ($price - $new);
        return $new_price;
    }

    function confirm($action, $do = '', $id, $msg){
        include '../template/confirm.php';
        return $do.$id;
    }

    function star($star, $qty_sale = ''){
        for($i=1; $i<=$star; $i++){
            echo '⭐';
        }
        if($qty_sale != 0){
            echo ' '.$star.'คะแนน ('.$qty_sale.'รีวิว)';
        } else {
            echo '⭐ยังไม่มีคะแนน';
        }
    }
    
    // ไม่จำเป็น
    function star2($star){
        $em = 5 - $star;
            for($i=1; $i<=$star; $i++){
                echo '&#9733';
            }
            for($x=1; $x<=$em; $x++){
                echo '&#9734';
            }
    }

    
    // echo 'PHP Version: ' . phpversion();
?>