<?php
	$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY thutu DESC";
	$query_lietke_danhmucsp = mysqli_query($mysqli,$sql_lietke_danhmucsp);
?>


<div class="main row">
<div class="col offset-2">
<p>Danh mục sản phẩm hiện có</p>
<div class="lietke">
    <table style="width:80%">
      <tr>
        <th>ID</th>
        <th>Tên Danh Mục</th>
        <th>Quản Lý</th>
      </tr>
      <?php
        $i = 0;
          while($row = mysqli_fetch_array($query_lietke_danhmucsp)){
            $i++;
      ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['tendanhmuc'] ?></td>
        <td>
            <button class="btn btn-danger" type="button">
              <a href="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc'] ?>">Xoá</a>
            </button>
            <button class="btn btn-warning" type="button">
              <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc'] ?>">Sửa</a> 
            </button>
        </td>
      
      </tr>
      <?php
        } 
      ?>
 
    </table>
    

</div>
</div>
</div>
