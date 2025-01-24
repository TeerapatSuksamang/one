<link rel="stylesheet" href="../style/style.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<script src="../bootstrap/js/bootstrap.min.js"></script>

<div class="toast fade show position-fixed we-toastt shadow bg-light">
<!-- <div class="toast fade show position-fixed bottom-0 end-0 m-3 we-toast shadow bg-light"> -->
    <div class="toast-header bg-primary text-light ">
        <!-- <div class="o hover-img me-1 " style="width: 2rem; aspect-ratio: 1/1;"> -->
            <!-- <img src="../img/ไอคอน/78.jpg" class="rounded me-2 img" alt=""> -->
        <!-- </div> -->
        <h5 class="me-auto">แจ้งเตือน</h5>
        <small>เมื่อสักครู่</small>
        <button type="button" class="btn-close we-close" onclick="hide();"></button>
    </div>

    <div class="timer-container">
        <div class="timer"></div>
    </div>

    <div class="toast-body">
        <?php echo $_SESSION['alert'] ?>
    </div>
</div>

<script>
    function hide(){
        const toast = document.querySelector('.toast');
        toast.classList.add('we-hide'); 
    }
</script>