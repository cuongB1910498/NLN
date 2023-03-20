<?php 
    // $sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc = '$_GET[id]' ORDER BY id_sanpham DESC";
    // $query_pro = mysqli_query($mysqli, $sql_pro);
    $query_pro = $pdo->prepare(
        "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc = :id ORDER BY id_sanpham DESC"
    );
    $query_pro->execute(['id' => $_GET['id']]);

    //ten Danh Muc
    // $sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc = '$_GET[id]' LIMIT 1";
    // $query_cate = mysqli_query($mysqli, $sql_cate);
    $query_cate = $pdo->prepare(
        "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc = :id LIMIT 1"
    );
    $query_cate->execute(['id' => $_GET['id']]);
    $row_title = $query_cate->fetch();
    
?>

<div class="show row">
    <p>DANH MỤC SẢN PHẨM: <?php echo $row_title['tendanhmuc'] ?></p>
    
    <?php
        while($row_pro = $query_pro->fetch()){
            $stmt = $pdo->prepare("SELECT * FROM tbl_anh WHERE masp = :ma");
            $stmt->execute([
                'ma'=>$row_pro['masp']
            ]);
            $Img = $stmt->fetch()
    ?>
    
    <div class="card col-lg-3 col-md-4 col-sm-6 col-12 " style="width:300px">
        <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
            <img class="card-img-top" src="admincp/modules/quanlysp/uploads/<?php echo $Img['tenanh'] ?>" alt="Card image">
        </a>   
            <div class="card-body">
                <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_pro['id_sanpham'] ?>" autocomplete="off">
                    <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
                        <h4 class="card-title"><?php echo $row_pro['tensanpham'] ?></h4>
                        <p class="card-text">Giá: <?php echo number_format($row_pro['giasp'],0,',','.').'vnđ'?></p>
                    </a>
                    <button class="themgiohang btn btn-info" name="themgiohang" type="submit" value="Thêm giỏ hàng">THÊM VÀO GIỎ</button>
                </form>
                
            </div>
       
    </div>
 
    <?php 
        }
    ?>

</div>
