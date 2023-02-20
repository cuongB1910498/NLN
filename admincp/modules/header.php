<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
  unset($_SESSION['admin']);
  header("Location:login.php");
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">ADMIN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=quanlydonhang">Đơn hàng</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            Saria-expanded="false">
            Quản lý
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?action=danhmuc">Quản lý Danh mục</a></li>
            <li><a class="dropdown-item" href="index.php?action=quanlysp">Quản lý Sản Phẩm</a></li>
            <li><a class="dropdown-item" href="index.php?action=thembaiviet">Quản lý bài viết</a></li>
          </ul>
        </li>
        <li class=" nav-item">
          <a class="nav-link" href="index.php?dangxuat=1" tabindex="-1">Đăng xuất</a>
        </li>
      </ul>
      <form class="d-flex" name="timkiem" action="index.php?action=timkiem&query=tim" method="Post">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search" name="key">
        <button class="btn btn-outline-success" type="submit">Tìm</button>
      </form>
    </div>
  </div>
</nav>

<!-- <div class="menu row">
  <div class="col offset-2">

    <button type="button" class="btn btn-primary"><a href="index.php?action=quanlydonhang&query=xemdon">QUẢN LÝ ĐƠN
        HÀNG</a></button>
    <button type="button" class="btn btn-primary"><a href="index.php?action=quanlydanhmucsanpham&query=them">Quản lý
        danh mục sản phẩm</a></button>
    <button type="button" class="btn btn-primary"><a href="index.php?action=quanlysp&query=them">Quản lý sản
        phẩm</a></button>
    <button type="button" class="btn btn-primary"><a href="index.php?action=quanlybaiviet&query=thembaiviet">Quản Lý
        Bài Viết</a></button>

  </div>
</div> -->