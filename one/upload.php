<?php 
    $temp = explode('.', $_FILES['img']['name']);
    $img = rand() . '.' . end($temp);
    $path = "../upload/" . $img;

?>