<?php
    if(isset($_GET['dangxuat']) && $_GET['dangxuat']== 1){
        unset($_SESSION['dangnhap']);
        header("Location:login.php");
    }
?>
<div class="header">
    <div class="h_tille row">
        <h1 class="col">Quản lý trang Web</h1>
    </div>

    <div class="h_status row">
        <div class="col d-flex justify-content-end">
            <button class="btn btn-warning"><a href="index.php?dangxuat=1">Đăng Xuất: <?php if(isset($_SESSION['dangnhap'])){
		echo $_SESSION['dangnhap'];

	} ?></a></button>
        </div>
    </div>
</div>