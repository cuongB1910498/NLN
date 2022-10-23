<?php
	$sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmuc]' LIMIT 1";
	$query_sua_danhmucsp = mysqli_query($mysqli,$sql_sua_danhmucsp);
?>
<div class="main row">
<div class="col offset-3">
	<p>Sửa danh mục sản phẩm</p>

	<form method="POST" action="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>" class="form-horizontal">
		
		<?php 
			while($dong = mysqli_fetch_array($query_sua_danhmucsp)) {
		?>
	
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Tên danh mục: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="tendanhmuc"  value="<?php echo $dong['tendanhmuc'] ?>">
				<label class="error"></label>
			</div>
		</div>
		
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Thứ Tự: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="thutu" value="<?php echo $dong['thutu'] ?>" >
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			
			<div class="col offset-2">
				<input class="btn btn-primary" type="submit" name="suadanhmuc" value="Sửa">
			</div>
							
		</div>
		
		<?php
	  		} 
	  	?>
		
	</form>

</div>
</div>