<!-- บั้ม -->
<?php if(isset($do)){ ?>

    <div class="modal fade" id="<?php echo $do.$id ?>"> 
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><?php echo $msg ?></h4>
                </div>
                <div class="modal-body">
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">ยกเลิก</button>
                        <a href="<?php echo $action.'?'.$do.'='.$id ?>" class="btn btn-success w-100">ยืนยัน</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <!-- มิกซ์ -->
    
    <form action="<?php echo $action ?>" method="post" class="modal fade" id="id<?php echo $row[$permis_id] ?>"> 
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><?php echo $msg ?></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="permis" value="<?php echo $permis ?>">
                    <input type="hidden" name="permis_id" value="<?php echo $permis_id ?>">
                    <input type="hidden" name="id" value="<?php echo $row[$permis_id] ?>">
                    <input type="hidden" name="status" value="0">
                    
                    <input type="text" name="note" class="form-control mb-3" placeholder="หมายเหตุ (ไม่จำเป็น)" value="">

                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">ยกเลิก</a>
                        <input type="submit" class="btn btn-success w-100" name="<?php echo $do ?>" value="ยืนยัน">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } ?>


