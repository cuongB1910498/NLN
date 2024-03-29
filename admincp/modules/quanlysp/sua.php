<div class="row">
	<div class="col-10 offset-1">
	<?php
	// $sql_sua_sp = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
	// $query_sua_sp = mysqli_query($mysqli,$sql_sua_sp);
	$change = $pdo->prepare(
		"SELECT * FROM tbl_sanpham WHERE masp = :ma LIMIT 1"
	);
	$change->execute([
		'ma' => $_GET['masp']
	]);
?>
<p>Sửa sản phẩm</p>
<table border="1" width="100%" style="border-collapse: collapse;">
<?php
while($row = $change->fetch()) {
?>
 <form method="POST" action="modules/quanlysp/xuly.php?masp=<?php echo $row['masp'] ?>" enctype="multipart/form-data">
	  <tr>
	  	<td>Tên sản phẩm</td>
	  	<td><input type="text" value="<?php echo $row['tensanpham'] ?>" name="tensanpham"></td>
	  </tr>
	   <tr>
	  	<td>Mã sp</td>
	  	<td><input type="text" value="<?php echo $row['masp'] ?>" name="masp"></td>
	  </tr>
	  <tr>
	  	<td>Giá sp</td>
	  	<td><input type="text" value="<?php echo $row['giasp'] ?>" name="giasp"></td>
	  </tr>
	  <tr>
	  	<td>Số lượng</td>
	  	<td><input type="text" value="<?php echo $row['soluong'] ?>" name="soluong"></td>
	  </tr>
	   <tr>
	  	<td>Hình ảnh</td>
	  	<td>
	  		<input type="file" name="files[]" multiple>
	  	</td>

	  </tr>
	  <tr>
	  	<td>Tóm tắt</td>
	  	<td><textarea rows="10"  name="tomtat" style="resize: none"><?php echo $row['tomtat'] ?></textarea></td>
	  </tr>
	   <tr>
	  	<td>Nội dung</td>
	  	<td><textarea rows="10"  name="noidung" style="resize: none"><?php echo  $row['noidung'] ?></textarea></td>
	  </tr>
	  <tr>
	    <td>Danh mục sản phẩm</td>
	    <td>
	    	<select name="danhmuc">
	    		<?php
	    		$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
	    		// $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
				$query_danhmuc = $pdo->prepare($sql_danhmuc);
				$query_danhmuc->execute();
	    		while($row_danhmuc = $query_danhmuc->fetch()){
	    			if($row_danhmuc['id_danhmuc']==$row['id_danhmuc']){
	    		?>
	    		<option selected value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
	    		<?php
	    			}else{
	    		?>
	    		<option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
	    		<?php
	    			}
	    		} 
	    		?>
	    	</select>
	    </td>
	  </tr>
	  <tr>
	    <td>Tình trạng</td>
	    <td>
	    	<select name="tinhtrang">
	    		<?php
	    		if($row['tinhtrang']==1){ 
	    		?>
	    		<option value="1" selected>Kích hoạt</option>
	    		<option value="0">Ẩn</option>
	    		<?php
	    		}else{ 
	    		?>
	    		<option value="1">Kích hoạt</option>
	    		<option value="0" selected>Ẩn</option>
	    		<?php
	    		} 
	    		?>

	    	</select>
	    </td>
	  </tr>
	  <tr>
		<td>Nền Tảng</td>
		
		<td>
			<select name="nentang">
				<?php
						$stmt = $pdo->prepare(
							"SELECT * FROM tbl_sanpham WHERE masp = :ma LIMIT 1"
						);
						$stmt->execute([
							'ma' => $_GET['masp']
						]);
						$row_nt=$stmt->fetch();
						
				?>
				<option value="intel" <?php echo ($row_nt['nentang'] == 'intel') ? 'selected' : ''; ?>>intel</option>
				<option value="amd" <?php echo ($row_nt['nentang'] == 'amd') ? 'selected' : ''; ?>>amd</option>
				<option value="0" <?php echo ($row_nt['nentang'] == '0') ? 'selected' : ''; ?>>không phụ thuộc</option>
			</select>
		</td>

	  </tr>
	   <tr>
	    <td colspan="2"><input type="submit" name="suasanpham" value="Sửa sản phẩm"></td>
	  </tr>
 </form>
 <?php
 } 
 ?>

</table>
	</div>
</div>