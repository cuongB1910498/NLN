<!-- menu -->
<?php
    if(isset($_GET['dangxuat']) && $_GET['dangxuat']== 1){
        unset($_SESSION['dangnhap']);
    }
?>
<div class="menu bg-warning row ">
  <div class="menu-L col-lg-7 col-md-12 col-sm-12 col-12 offset-1">
                
    <button type="button" class="btn btn-primary"><a href="index.php">Trang chủ</a></button>
    <button type="button" class="btn btn-primary"><a href="index.php?quanly=tintuc">Tin Tức</a></button>
    <button type="button" class="btn btn-primary"><a href="index.php?quanly=khuyenmai">Khuyến mãi</a></button>
    <button type="button" class="btn btn-primary"><a href="index.php?quanly=lienhe">Liên Hệ</a></button>
                
  </div>

  <?php
    if(isset($_SESSION['dangnhap'])){
  ?>  
  <div class="menu-r col-lg-4 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
    <button class="btn btn-success"><a href="index.php?dangxuat=1">Đăng Xuất: <?php if(isset($_SESSION['dangnhap'])){
		echo $_SESSION['dangnhap'];} ?></a></button>
  </div>

  <?php
   }else{ 
  ?>
  <div class="menu-r col-lg-4 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
    <button class="btn btn-success"><a href="pages/main/dangnhap.php"><i class="fa-solid fa-user"></i> Đăng Nhập</a></button>
    <button class="btn btn-success"><a href="pages/main/dangky.php"><i class="fa-solid fa-pen-to-square"></i> Đăng Ký</a></button>
  </div>
  <?php 
    } 
  ?>
</div>