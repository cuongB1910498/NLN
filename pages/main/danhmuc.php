<?php 
    $sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc = '$_GET[id]' ORDER BY id_sanpham DESC";
    $query_pro = mysqli_query($mysqli, $sql_pro);

    //ten Danh Muc
    $sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc = '$_GET[id]' LIMIT 1";
    $query_cate = mysqli_query($mysqli, $sql_cate);
    $row_title = mysqli_fetch_array($query_cate);
?>

<div class="show row">
    <p>DANH MỤC SẢN PHẨM: <?php echo $row_title['tendanhmuc'] ?></p>
    
    <?php
        while($row_pro = mysqli_fetch_array($query_pro)){
    ?>
    
    <div class="card col-lg-3 col-md-4 col-sm-6 col-12 " style="width:300px">
        <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
            <img class="card-img-top" src="admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh'] ?>" alt="Card image">
        </a>   
            <div class="card-body">
                <form method="POST" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_pro['id_sanpham'] ?>">
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
