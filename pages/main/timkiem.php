<div class="show row">
<?php
    // $select = "SELECT * FROM tbl_sanpham";
    // if(isset($_POST['tiemkiem'])){
    //     $tukhoa = $_POST['tukhoa'];
    //     //tìm kiếm dựa trên tên sản phẩm
    //     $sql_tukhoa = " WHERE tensanpham LIKE :tk";
    // }
    // $sql = "$select $sql_tukhoa";
    //$sql1 = "SELECT * FROM tbl_sanpham as a WHERE tensanpham LIKE '%".$tukhoa."%'";
    //echo $sql;
    //echo "<br>";
    //echo $sql1;
    // $query_pro = mysqli_query($mysqli, $sql);
    $tukhoa = $_POST['tukhoa'];
    $query_pro = $pdo->prepare(
        "SELECT * FROM tbl_sanpham WHERE tensanpham LIKE :tk"
    );
    $query_pro->execute([
        'tk' => '%'.$tukhoa.'%'
    ]);
?>
<p>Kết quả cho từ khóa: <?php echo $tukhoa; ?></p>
    
    <?php
        $i=0;
        while($row = $query_pro->fetch()){
            $stmt = $pdo->prepare("SELECT * FROM tbl_anh WHERE masp = :ma LIMIT 1");
            $stmt->execute(['ma'=>$row['masp']]);
            $Img = $stmt->fetch();
    ?>
    <div class="card col-lg-3 col-md-4 col-sm-6 col-12 " style="width:300px">
        <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row['id_sanpham'] ?>">
            <a href="index.php?quanly=sanpham&id=<?php echo $row['id_sanpham'] ?>">
                <img class="card-img-top" src="admincp/modules/quanlysp/uploads/<?php echo $Img['tenanh'] ?>" alt="Card image">
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
            if(isset($row)) $i++;
        }
        if($i == 0){
    ?>
    <h2>Không có kết quả tìm kiếm phù hợp </h2>
    <?php }?>
</div>