<!-- menu -->
<?php
    if(isset($_GET['dangxuat']) && $_GET['dangxuat']== 1){
        unset($_SESSION['dangnhap']);
        header("Location:index.php");
        echo '<script>alert("Bạn đã đăng xuất!");</script>';
        
    }
    $query_danhmuc = $pdo->prepare(
      "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC"
    );
    $query_danhmuc->execute();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">THYNc</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Danh mục sản phẩm
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
              while($row_danhmuc = $query_danhmuc->fetch()){
            ?>
            <li><a class="dropdown-item" href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php  echo $row_danhmuc['tendanhmuc'] ?></a></li>
            <?php
              }
            ?>

          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?quanly=tintuc">Bài Viết</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?quanly=khuyenmai">Khuyến mãi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?quanly=lienhe">Liên hệ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?quanly=buildpc">Tự xậy dựng PC</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        
      </ul>
      <form class="d-flex mb-3" action="index.php?quanly=timkiem" method="POST">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="tukhoa">
        <button class="btn btn-warning me-2" type="submit" name="tiemkiem">Search</button>
      </form>
      <a href="index.php?quanly=giohang" class="btn btn-warning"><i class="fa-solid fa-cart-shopping "></i></a>
    </div>
  </div>
</nav>

