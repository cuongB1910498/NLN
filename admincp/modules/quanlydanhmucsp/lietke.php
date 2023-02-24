<?php
	// $sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu DESC";
	// $query_lietke_danhmucsp = mysqli_query($mysqli,$sql_lietke_danhmucsp);

$stmt = $pdo->prepare(
  "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC"
);

$stmt->execute();
?>

<div class="main row">
<div class="col offset-2">
<p>Danh mục sản phẩm hiện có</p>
<div class="lietke">
  <table style="width:80%">
    <tr>
      <th>ID</th>
      <th>Tên Danh Mục</th>
      <th>Build PC ?</th>
      <th>Quản Lý</th>
    </tr>
    <?php
      $i = 0;
      while($row = $stmt->fetch()){
        $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row['tendanhmuc'] ?></td>
      <td><?php if($row['buildpc']) echo "có"; else echo "Không"?></td>
        <td>
            
            <button class="btn btn-warning" type="button">
              <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc'] ?>">Sửa</a> 
            </button>
            
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $i ?>">
              Xóa
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $i ?>"  aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắt muốn xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p> - XÓA LÀ KHÔNG THỂ KHÔI PHỤC</p>
                    <p> - XÓA DANH MỤC NÀY THÌ TOÀN BỘ SẢN PHẨM THUỘC DANH MỤC SẼ BỊ XÓA</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <a class="btn btn-danger" href="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc'] ?>">Đồng ý</a>
                  </div>
                </div>
              </div>
            </div>
            
        </td>
      
      </tr>
      <?php
        } 
      ?>
    </table>
</div>
</div>
</div>

