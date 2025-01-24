<div class="col-lg-3 col-md-4 col-sm-6 col-6 p-1">
    <a href="" class="text-dark" data-bs-toggle="modal" data-bs-target="#see_food_<?php echo $row['food_id'] ?>">
        <div class="card hover-img shadow mb-3">
            <div class="card-img-top hover-img" style="height: 200px;">
                <img src="../upload/<?php echo $row['img'] ?>" class="img">
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['food_name'] ?></h5>
                <h6>
                    <?php if($row['discount'] != 0){ ?>
                        <s class="text-secondary">฿<?php echo $row['price'] ?></s>
                        <span class="text-success">฿<?php echo $row['new_price'] ?></span>
                        <span class="text-danger">(ลด <?php echo $row['discount'] ?>%)</span>
                    <?php } else { echo '฿'.$row['price']; } ?>
                </h6>
                <p>
                    <?php
                        star($row['star'], $row['qty_sale']);
                    ?>
                </p>
            </div>
        </div>
    </a>
</div>