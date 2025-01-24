<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <?php
        $member = 'admin';
        $member_id = 'admin_id';
        
        include_once 'nav.php';
        if(isset($_GET['page'])){
            if(file_exists($_GET['page'].'.php')){
                include_once $_GET['page'].'.php';
            }else{
                echo "<h1 class='text-center blockquote-footer mt-5 pt-5'>ขออภัยไม่พบหน้านี้</h1>";
            }
        }else{
            include 'web_manage.php';
        }
    
    ?>
</body>
</html>