<div class="menu">
  <?php
    if(isset($_SESSION['dangnhap'])){
  ?>  
  <div class="d-flex justify-content-end">
    <div class="btn-group" role="group">
      <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-user"></i> Tài khoản của tôi
      </button>
      <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <li><a class="dropdown-item" href="index.php?quanly=qltaikhoan">Quản lý tài khoản</a></li>
        <li><a class="dropdown-item" href="index.php?quanly=diachi">Địa Chỉ giao hàng</a></li>
        <li><a class="dropdown-item" href="index.php?quanly=lichsudon">Lịch sử Đặt hàng</a></li>
        <li><a class="dropdown-item" href="index.php?dangxuat=1">Đăng Xuất</a></li>
      </ul>
    </div>
  </div>

  <?php
   }else{ 
  ?>
  <div class="d-flex justify-content-end">
    <button class="btn btn-success"><a href="pages/main/dangnhap.php"><i class="fa-solid fa-user"></i> Đăng Nhập</a></button>
    <button class="btn btn-success"><a href="pages/main/dangky.php"><i class="fa-solid fa-pen-to-square"></i> Đăng Ký</a></button>
  </div>
  <?php 
    } 
  ?>
</div>