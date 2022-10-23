
<?php
	$sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham='$_GET[id]' LIMIT 1";
	$query_chitiet = mysqli_query($mysqli,$sql_chitiet);
	while($row_chitiet = mysqli_fetch_array($query_chitiet)){
?>

<div class="row">
    <p>CHI TIẾT SẢN PHẨM</p>
    <div class="pic col-lg-5 col-md-4 col-sm-4 col-12">
        <img src="admincp/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh'] ?>" alt="error_pic">
    </div>
    <div class="cont col-lg-7 col-md-7 col-sm-7 col-12">
        <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">
            <div class="chitiet_sanpham">
                <h3>Tên sản phẩm : <?php echo $row_chitiet['tensanpham'] ?></h3>
                <p>Mã sp: <?php echo $row_chitiet['masp'] ?></p>
                <p>Giá sp: <?php echo number_format($row_chitiet['giasp'],0,',','.').'vnđ' ?></p>
                <p>
                    Tình trạng: 
                    <?php
                     if($row_chitiet['soluong'] > 0) echo "còn hàng"; else echo "hết hàng";
                    ?>
                </p>
                <p>Danh mục sp: <?php echo $row_chitiet['tendanhmuc'] ?></p>
                <p><button class="themgiohang btn btn-info" name="themgiohang" type="submit" value="Thêm giỏ hàng">THÊM VÀO GIỎ</button></p>
                
            </div>
        </form>
    </div>
</div>

<?php
} 
?>

