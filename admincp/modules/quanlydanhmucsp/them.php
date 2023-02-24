<?php
	$stmt = $pdo->prepare(
		"SELECT MAX(thutu) as max FROM tbl_danhmuc LIMIT 1"
	);
	$stmt->execute();
	$row = $stmt->fetch();
?>

<div class="main row">
<div class="col offset-2">
	<p>Thêm danh mục sản phẩm</p>

	<form method="POST" class="form-horizontal" id="them" action="modules/quanlydanhmucsp/xuly.php">
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Tên danh mục: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="tendanhmuc"  placeholder="Tên danh mục..." >
				<label class="error"></label>
			</div>
		</div>
		
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Thứ Tự: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<input type="text" name="thutu"  placeholder="thứ tự..." value="<?php echo $row['max']+1?>">
				<label class="error"></label>
			</div>
		</div>
		
		<div class="form-group mb-4 row">
			<label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="buildpc">Xây đựng cấu hình?: </label>
			<div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
				<select name="buildpc" id="buildpc">
					<option selected value="0">Không</option>
					<option value="1">Có</option>
				</select>
				<label class="error"></label>
			</div>
		</div>

		<div class="form-group mb-4 row">
			
			<div class="col offset-2">
				<input class="btn btn-primary" type="submit" name="themdanhmuc" value="Thêm danh mục sản phẩm">
			</div>
							
		</div>
		
		
	</form>

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
        $(document).ready(function (){
            $("#them").validate({
                rules:{
                    tendanhmuc: {required:true},
                    thutu: {required:true}
                },
                messages:{
                    tendanhmuc: {required:"Tên danh mục không được trống"},
                    thutu: {required:"Thứ tự k được trống"}
                },
                
            });
        });

</script>

