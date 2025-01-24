<form action="add_cart_db.php" method="post" class="modal fade" id="see_food_<?php echo $row['food_id'] ?>" onmousemove="up_<?php echo $row['food_id'] ?>();">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">food_name</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <img src="../upload/<?php echo $row['img'] ?>" class="img" style="max-height: 18rem;">
            <div class="modal-body">
                <p class="d-flex">
                    <?php  
                        if($row['discount'] != 0){
                            $price = $row['new_price'];
                    ?>
                        <s class="text-secondary">฿<?php echo $row['price'] ?></s>
                        <span class="text-success">฿<?php echo $row['new_price'] ?></span>
                        <span class="text-danger">(ลด <?php echo $row['discount'] ?>%)</span>
                    <?php 
                        } else {
                            $price = $row['price'];
                            echo '฿'.$price;
                        }
                    ?>
                </p>
                <div class="d-flex gap-2">
                    <p class="btn btn-warning" onclick="minus_<?php echo $row['food_id'] ?>();">➖</p>
                    <input type="number" min="1" max="100" class="form-control h-25" name="qty" id="qty_<?php echo $row['food_id'] ?>" value="1">
                    <p class="btn btn-primary" onclick="plus_<?php echo $row['food_id'] ?>();">➕</p>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="food_id" value="<?php echo $row['food_id'] ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <input type="submit" class="btn btn-success" name="add_cart" id="sum_<?php echo $row['food_id'] ?>" value="เพิ่มลงตะกร้า ฿<?php echo $price ?>">
            </div>
        </div>
    </div>
</form>

<script>
    function plus_<?php echo $row['food_id'] ?>(){
        var input = document.getElementById('qty_<?php echo $row['food_id'] ?>');
        var input_value = parseInt(input.value);
        input.value = input_value + 1;

        var sum = document.getElementById('sum_<?php echo $row['food_id'] ?>');
        sum.value = "เพิ่มลงตะกร้า ฿" + (input.value * <?php echo $price ?>);
    }

    function minus_<?php echo $row['food_id'] ?>(){
        var input = document.getElementById('qty_<?php echo $row['food_id'] ?>');
        var input_value = parseInt(input.value);
        if(input_value > 1){
            input.value = input_value - 1;
        }

        var sum = document.getElementById('sum_<?php echo $row['food_id'] ?>');
        sum.value = "เพิ่มลงตะกร้า ฿" + (input.value * <?php echo $price ?>);
    }

    function up_<?php echo $row['food_id'] ?>(){
        var input = document.getElementById('qty_<?php echo $row['food_id'] ?>');
        var input_value = parseInt(input.value); 

        var sum = document.getElementById('sum_<?php echo $row['food_id'] ?>');
        sum.value = "เพิ่มลงตะกร้า ฿" + (input.value * <?php echo $price ?>);
    }
</script>