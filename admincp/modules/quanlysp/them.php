<p>Thêm sản phẩm</p>

<div class="main row">
<div class="col offset-2">
	<p>Thêm sản phẩm</p>

	<form method="POST" class="form-horizontal" id="them" action="modules/quanlysp/xuly.php" enctype="multipart/form-data">
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Sản Phẩm: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="tensanpham"  placeholder="Tên Sản Phẩm..." >
				<label class="error"></label>
			</div>
		</div>
		
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Mã sản phẩm:</label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="masp"  placeholder="Mã Sản Phẩm... ">
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Giá sản phẩm: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="giasp"  placeholder="Giá Sản Phẩm... ">
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Số Lượng: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="soluong"  placeholder="Số Lượng... ">
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Hình Ảnh: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="file" name="hinhanh"  placeholder="Hình Ảnh... ">
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Tóm tắt: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="tomtat"  placeholder="Tóm Tắt... ">
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Nội Dung: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="noidung"  placeholder="Nội Dung... ">
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Danh Mục sản Phẩm: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<select name="danhmuc">
					<?php
					$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
					$query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
					while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
					?>
					<option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
					<?php
					} 
					?>
				</select>
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Tình Trạng: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<select name="tinhtrang">
					<option value="1">Kích hoạt</option>
					<option value="0">Ẩn</option>
				</select>
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			
			<div class="col offset-2">
				<input class="btn btn-primary" type="submit" name="themsanpham" value="Thêm sản phẩm">
			</div>
							
		</div>
		
		
	</form>

</div>
</div>