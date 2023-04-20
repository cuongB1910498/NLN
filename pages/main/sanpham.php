
<?php
	// $sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham='$_GET[id]' LIMIT 1";
	// $query_chitiet = mysqli_query($mysqli,$sql_chitiet);
    $query_chitiet = $pdo->prepare(
        "SELECT * FROM tbl_sanpham as a,tbl_danhmuc as b
            WHERE a.id_danhmuc=b.id_danhmuc AND a.id_sanpham= :id LIMIT 1"
    );
    $query_chitiet->execute([
        'id' => $_GET['id']
    ]);
	while($row_chitiet = $query_chitiet->fetch()){
?>

    <div class="row productdetail">
        <?php
            $stmt = $pdo->prepare("SELECT * FROM tbl_anh WHERE masp = :ma");
            $stmt->execute(['ma'=>$row_chitiet['masp']]);
            $ImgThumnail = $stmt -> fetch();
            
        ?>
        <div class="col-lg-6 col-md-6 col-12" id="slide">
            <div class="main-slide">
                <img src="<?php echo $ImgThumnail['link'] ?>" class="img-feature">
                <div class="coltrol pre"><i class="fa-duotone fa-arrow-left"></i></div>
                <div class="coltrol next"><i class="fa-duotone fa-arrow-right"></i></div>
            </div>
            <div class="list-image">
                <?php
                    $Img = $pdo->prepare("SELECT * FROM tbl_anh WHERE masp = :ma");
                    $Img->execute(['ma'=>$row_chitiet['masp']]);
                    $rows = $Img->fetchAll();
                    foreach($rows as $row){
                ?>
                <div><img src="<?php echo $row['link'] ?>" hidden></div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-12">
            <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>" autocomplete="off">
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

