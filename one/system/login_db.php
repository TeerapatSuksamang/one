<?php 

    include_once '../db.php';
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $member = $_POST['member'];

        $select = mysqli_query($conn, "SELECT * FROM `$member` WHERE `username` = '$username' ");
        if($select -> num_rows > 0){
            $row = mysqli_fetch_array($select);
            
            if(password_verify($password, $row['password'])){
                if($member == 'admin'){
                    $_SESSION['admin_id'] = $row['admin_id'];
                    header('location: ../admin/index.php');
                } else {
                    if($row['status'] == 1){
                        $member_id = ($member == 'restaurant' ? 'res_id' : $member.'_id');
                        $_SESSION[$member_id] = $row[$member_id];
                        header('location: ../'.$member.'/index.php');
                    } else {
                        if($row['note'] != null){
                            alert('คุณถูกระงับการใช้งาน หมายเหตุ: '.$row['note']);
                        } else {
                            alert('ยังไม่ได้รับอนุมัติการใช้งาน');
                        }
                    }
                }
            } else {
                alert('รหัสผ่านไม่ถูกต้อง', '', 'password');
            }
        } else {
            alert('ชื่อผู้ใช้ไม่ถูกต้อง', '', 'username');
        }
    }


?>