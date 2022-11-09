
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
    
    $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
    ORDER BY tbl_sanpham.id_sanpham DESC LIMIT $begin, $inpage";
    $query_pro = mysqli_query($mysqli, $sql_pro);
?>


<p>Sản phẩm nổi bật

</p>
    
    <?php
        while($row = mysqli_fetch_array($query_pro)){
    ?>
    <div class="card col-lg-3 col-md-4 col-sm-6 col-12 mb-3" style="width:300px">
        <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row['id_sanpham'] ?>">
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img class="card-img-top" src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" alt="Card image">
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
        $sql_trang = mysqli_query($mysqli,"SELECT * FROM tbl_sanpham");
        $dem_dong = mysqli_num_rows($sql_trang);
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
