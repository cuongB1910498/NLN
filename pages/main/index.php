
<div class="show row">
<?php 
    $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc
    ORDER BY tbl_sanpham.id_sanpham DESC LIMIT 6";
    $query_pro = mysqli_query($mysqli, $sql_pro);
?>
<p>Sản phẩm nổi bật

</p>
    
    <?php
        while($row = mysqli_fetch_array($query_pro)){
    ?>
    <div class="card col-lg-3 col-md-4 col-sm-6 col-12 " style="width:300px">
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
    
    
</div>
