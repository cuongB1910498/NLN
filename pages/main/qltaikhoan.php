<div class="qltaikhoan">
<?php
    // echo "day la trang ql tk <br>";
    // echo "id = ".$_SESSION['dangnhap'];
    $id_dangky = $_SESSION['dangnhap'];
    $sql = "SELECT * FROM tbl_dangky WHERE id_dangky=$id_dangky";
    // echo "<br>".$sql;
    $query = mysqli_query($mysqli, $sql);
    
?>

<?php 
    
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $sql = "SELECT * FROM tbl_dangky WHERE id_dangky = $id_dangky";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
    }elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
        $tenkhachhang = $_POST['tenkhachhang'];
        $dienthoai = $_POST['dienthoai'];
        $sql_luu = "UPDATE tbl_dangky SET tenkhachhang = '".$tenkhachhang."', dienthoai = '".$dienthoai."' 
        WHERE id_dangky = $id_dangky";
        $query_luu = mysqli_query($mysqli , $sql_luu);
        echo '<script>alert("ĐÃ CẬP NHẬT");</script>'; 
        $page = "index.php?quanly=qltaikhoan";
        
        header("Refresh: 0; url=$page");
          
    }
    

?>

    
    <!-- main -->
    <div class="card">
        <div class="card-header">
            <h3>THÔNG TIN TÀI KHOẢN</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST" class="form-horizontal" id="qltaikhoan">
                <div class="form-group row mb-3">
					<label class="col-sm-4 col-form-label offset-1" for="firstname">Tên của bạn: </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="firstname" name="tenkhachhang" value="<?php if(isset($row)) echo $row['tenkhachhang'] ?>"/>
					</div>
				</div>

                <div class="form-group row mb-3">
					<label class="col-sm-4 col-form-label offset-1" for="email">Email: </label>
					<div class="col-sm-5">
						<input type="email" class="form-control" id="email" name="firstname" value="<?php if(isset($row)) echo $row['email'] ?>" disabled />
					</div>
				</div>

                <div class="form-group row mb-3">
					<label class="col-sm-4 col-form-label offset-1" for="STD" >SDT:  </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="STD" name="dienthoai" value="<?php if(isset($row)) echo $row['dienthoai'] ?>"/>
					</div>
				</div>

                <div class="row">
					<div class="col-sm-5 offset-sm-4">
						<button type="submit" class="btn btn-primary" name="luu">LƯU</button>
				    </div>
				</div>

            </form>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function(){
        $("#qltaikhoan").validate({
            rules:{
                tenkhachhang: {required: true, minlength: 5},
                dienthoai:{required:true, minlength:10, maxlength:10, number: true}
            },
            messages: {
                tenkhachhang: {required: "Họ tên không được bỏ trống!", minlength: "Họ tên quá ngắn !"},
                dienthoai:{required:"Số điện thoại không được bỏ trống!", minlength:"số điện thoại chỉ có 10 số", maxlength: "số điện thoại chỉ có 10 số", number: "bạn chỉ được nhập số"}
            }
        });
    });
</script>