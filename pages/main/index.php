
<div class="show row">
<?php 
    // 1 trang có bao nhiêu sản phẩm - ở đây là 4
    $inpage = 4;
    if(isset($_GET['trang'])){
		$page = $_GET['trang'];
	}else{
		$page = 1;
	}
	if($page == '' || $page == 1){
		$begin = 0;
	}else{
		$begin = ($page*$inpage)-$inpage;
	}
    
    // $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
    // ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin, $inpage";
    // $query_pro = mysqli_query($mysqli, $sql_pro);
    $query_pro = $pdo->prepare(
        "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
        AND tinhtrang = 1
        ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin, $inpage"
    );
    $query_pro->execute();
?>

<!-- Carousel -->

<div id="carouselExampleIndicators" class="carousel slide mb-3" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/slide_1.jpg" class="d-block w-100 h-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/slide_2.jpg" class="d-block w-100 h-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/slide_3.jpg" class="d-block w-100 h-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="alert alert-success mb-3" role="alert">
<h2>Sản Phẩm Mới</h2>
</div>
    
    <?php
        while($row = $query_pro->fetch()){
            $stmt = $pdo->prepare("SELECT * FROM tbl_anh WHERE masp = :ma");
            $stmt->execute([
                'ma'=>$row['masp']
            ]);
            $Img = $stmt->fetch()
    ?>
    <div class="card col-lg-3 col-md-4 col-sm-6 col-12 mb-3" style="width:300px">
        <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row['id_sanpham'] ?>" autocomplete="off">
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img class="card-img-top" src="<?php echo $Img['link'] ?>" alt="Card image">
            </a>
                <div class="card-body">
                    <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                        <h4 class="card-title"><?php echo $row['tensanpham'] ?></h4>
                        <p class="card-text">Giá: <?php echo number_format($row['giasp'],0,',','.').'vnđ'?></p>
                    </a>
                    <button class="themgiohang btn btn-info" name="themgiohang" type="submit" value="Thêm giỏ hàng">THÊM VÀO GIỎ</button>
                </div>
        </form>
    </div>
    
    <?php
        }
    ?>
    

    <?php
        // $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham");
        $sql_trang = $pdo->prepare(
            "SELECT * FROM tbl_sanpham"
        );
        $sql_trang->execute();
        $row = $sql_trang->fetch();
        $dem_dong = 8;
        $trang = ceil($dem_dong/$inpage);
    ?>
    <!-- phan trang -->
    <nav aria-label="..." class="mb-3">
    <ul class="pagination pagination-sm">
        <?php
            for($i = 1; $i<=$trang; $i++){

            
        ?>
        <li class="page-item <?php if($i==$page) echo "disabled" ?>">
        <a class="page-link" href="index.php?trang=<?php echo $i ?>" tabindex="-1"><?php echo $i ?></a>
        </li>

        <?php
            }
        ?>
        
    </ul>
    </nav>
    
</div>
