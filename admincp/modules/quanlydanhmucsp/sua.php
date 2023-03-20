<?php
	// $sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmuc]' LIMIT 1";
	// $query_sua_danhmucsp = mysqli_query($mysqli,$sql_sua_danhmucsp);
$stmt = $pdo->prepare(
	"SELECT * FROM tbl_danhmuc WHERE id_danhmuc = :id LIMIT 1"
);

$stmt->execute(['id'=> $_GET['iddanhmuc']]);
$dong = $stmt->fetch()
?>
<div class="main row">
<div class="col offset-3">
	<p>Sửa danh mục sản phẩm</p>

	<form method="POST" action="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>" class="form-horizontal" autocomplete="off">
	
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Tên danh mục: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="tendanhmuc"  value="<?php echo $dong['tendanhmuc'] ?>">
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="buildpc">Xây đựng cấu hình?: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<select name="buildpc" id="buildpc">
					<option <?php if ($dong['buildpc'] == '0') echo "selected"?> value="0">Không</option>
					<option <?php if ($dong['buildpc'] == '1') echo "selected"?> value="1">Có</option>
				</select>
				<label class="error"></label>
			</div>
		</div>
		
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Thứ Tự: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="thutu" value="<?php echo $dong['thutu'] ?>" disabled>
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			
			<div class="col offset-2">
				<input class="btn btn-primary" type="submit" name="suadanhmuc" value="Sửa">
			</div>
							
		</div>
			
	</form>

</div>
</div>
