<?php 
  $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
  $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
?>
<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
  Danh mục sản phẩm
</button>
<ul class="dropdown-menu">
  
  <?php  
  while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
  ?>
    <li><a class="dropdown-item" href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a></li>
  <?php 
  }
  ?>
    

  
</ul>
