<div class="container">
    <div class="row my-5">
        <div class="col-md-6">
            <h2>ร้านอาหาร</h2>
        </div>
        <div class="col-md-6">
            <form action="index.php" class="d-flex gap-2 float-end" method="get">
                <?php
                    if(isset($_GET['find'])){
                        $find = $_GET['find'];
                    } else {
                        $find = '';
                    }
                    if($find != ''){
                ?>
                    <a href="index.php" class="btn btn-warning text-nowrap">รีเซ็ท</a>
                <?php } ?>
                <input type="search" class="form-control" name="find" placeholder="ร้านไหนดีครับ" value="<?php echo $find ?>">
                <input type="submit" class="btn btn-primary" value="ค้นหา">
            </form>
        </div>

        <?php 
            if($find != ''){
                $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_name` LIKE '%$find%' AND `status` = 1 ");
            } else {
                $select = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `status` = 1 ");
            }
            if($select -> num_rows > 0){
                while($row = mysqli_fetch_array($select)){
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
                <a href="see_res.php?rider_see_res=<?php echo $row['res_id'] ?>" class="text-dark">
                    <div class="card hover-img shadow mb-3">
                        <div class="card-img-top hover-img" style="height: 200px;">
                            <img src="../upload/<?php echo $row['img'] ?>" class="img">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['res_name'] ?></h5>
                            <h6><?php echo $row['res_type'] ?> | ⭐<?php echo ($row['star'] == 0 ? 'ยังไม่มีคะแนน' : $row['star'].'คะแนน ('.$row['qty_sale'].' รีวิว)') ?></h6>
                            <p class="text-truncate"><?php echo $row['address'] ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php }} else { ?>
            <p class="text-center blockquote-footer my-3">ไม่พบร้านอาหารที่ค้นหา</p>
        <?php } ?>
    </div>
</div>