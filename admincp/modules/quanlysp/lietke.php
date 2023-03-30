<?php
	// $sql_lietke_sp = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc ORDER BY id_sanpham DESC";
	// $query_lietke_sp = mysqli_query($mysqli,$sql_lietke_sp);
$list = $pdo->prepare(
  "SELECT * FROM tbl_sanpham as a, tbl_danhmuc as b 
    WHERE a.id_danhmuc = b.id_danhmuc
    ORDER BY id_sanpham DESC"
);
$list->execute();
?>
<div class="mb-3"></div>
<div class="row" id="themsp">
  <div class="col-2 d-flex justify-content-end offset-lg-1 offset-1"><a href="index.php?action=themsp" class="col btn btn-primary">Thêm sản phẩm</a></div>
</div>


<div class="row offset-lg-1 offset-1" id="hienthi">
<p>tất cả sản phẩm</p>
  <?php
    $i = 0;
    while($row = $list->fetch()){
      $i++;

      //get image
      $getImg = $pdo->prepare("SELECT * from tbl_anh WHERE masp = :ma ORDER BY id_anh ASC LIMIT 1");
      $getImg->execute([
        'ma'=>$row['masp']
      ]);
      $anh = $getImg->fetch();
  ?>
  <div class="card col-lg-3 col-md-4 col-sm-6 col-12" style="width:300px" id="card">
    <div class="card-title">
      <img class="card-img-top" id="img" src="<?php echo $anh['link'] ?>" alt="Card image"> 
    </div>
    <div class="card-body">
            <h4 class="card-title"><?php echo $row['tensanpham'] ?></h4>
            <p class="card-text">Giá: <?php echo number_format($row['giasp'],0,',','.').'vnđ'?></p>
    </div>
    <div class="row mb-3 offset-2">
      <a href="index.php?action=suasp&masp=<?php echo $row['masp'] ?>" class="themgiohang btn btn-warning col-4" name="themgiohang" type="submit" value="Thêm giỏ hàng">Sửa</a>
        <div class="col-2"></div>
          <!-- del btn -->
          <button class="themgiohang btn btn-danger col-4" type="button" data-bs-toggle="modal" data-bs-target="#modal<?php echo $i ?>">Xóa</button>
          <!-- modal -->
          <div class="modal fade" id="modal<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chú ý</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                hãy suy nghĩ cho thật kỹ xóa là không thể khôi phục
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <a href="modules/quanlysp/xuly.php?masp=<?php echo $row['masp'] ?>" type="submit" class="btn btn-danger">Xóa</a>
              </div>
            </div>
          </div>
        </div>  
    </div>
  </div>

  <?php
    }
  ?>
</div>
