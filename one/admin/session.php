<?php

    include_once '../db.php';
    if(!$_SESSION['admin_id']){
        header('location: ../login.php?member=admin');
    }

?>