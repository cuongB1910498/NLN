<!-- menu -->
<?php
    if(isset($_GET['dangxuat']) && $_GET['dangxuat']== 1){
        unset($_SESSION['dangnhap']);
        header("Location:index.php");
        echo '<script>alert("Bạn đã đăng xuất!");</script>';
        
    }
?>
<div class="menu row ">
  <div class="menu-L col-lg-8 col-md-12 col-sm-12 col-12 ">
                
    <button type="button" class="btn btn-primary"><a href="index.php">Trang chủ</a></button>
    <?php 
      // $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
      // $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
    $query_danhmuc = $pdo->prepare(
      "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC"
    );
    $query_danhmuc->execute();
    ?>
    <button type="button" class="btn btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" id="navbarDropdownMenuLink">
    Danh mục sản phẩm
    </button>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
  
      <?php  
      while($row_danhmuc = $query_danhmuc->fetch()){
      ?>
        <li><a class="dropdown-item" href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>" width="500px"><?php echo $row_danhmuc['tendanhmuc'] ?></a></li>
      <?php 
      }
      ?>
    </ul>
    <button type="button" class="btn btn btn-primary"><a href="index.php?quanly=tintuc">Bài viết</a></button>
    <button type="button" class="btn btn btn-primary"><a href="index.php?quanly=khuyenmai">Khuyến mãi</a></button>
    <button type="button" class="btn btn btn-primary"><a href="index.php?quanly=lienhe">Liên Hệ</a></button>
    <button type="button" class="btn btn btn-primary"><a href="index.php?quanly=buildpc">Tự xây dựng PC</a></button>
  </div>

  <?php
    if(isset($_SESSION['dangnhap'])){
  ?>  
  <div class="menu-r col-lg-4 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
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
  <div class="menu-r col-lg-4 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
    <button class="btn btn-success"><a href="pages/main/dangnhap.php"><i class="fa-solid fa-user"></i> Đăng Nhập</a></button>
    <button class="btn btn-success"><a href="pages/main/dangky.php"><i class="fa-solid fa-pen-to-square"></i> Đăng Ký</a></button>
  </div>
  <?php 
    } 
  ?>
</div>