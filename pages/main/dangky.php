<?php
    // $sql_mailcheck = "SELECT email FROM tbl_dangky";
    // $sql_check = mysqli_query($mysqli, $sql_mailcheck);
    // $i=0;
    // $err= "";
    // if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //     $mail = $_POST["email"];
    // }
    // while($row = mysqli_fetch_array($sql_check)){
    //     if($row['email'] == $mail){
    //         $err = "email đã có người sử dụng!";
    //         break;
    //     }else{
    //         $err = "";
    //     }
    //     $i++;
    // }
    
    // function test_input($data) {
    //     $data = trim($data);
    //     $data = stripslashes($data);
    //     $data = htmlspecialchars($data);
    //     return $data;
    // }
?>
<?php
    session_start();
	include("../../admincp/config/config.php");
	if(isset($_POST['dangky'])) {
		$tenkhachhang = $_POST['hovaten'];
		$email = $_POST['email'];
        
                        
		$dienthoai = $_POST['dienthoai'];
		$matkhau = md5($_POST['matkhau']);
		$diachi = $_POST['diachi'];
        
        $sql = "INSERT INTO tbl_dangky(tenkhachhang,email,diachi,matkhau,dienthoai) 
            VALUE('".$tenkhachhang."','".$email."','".$diachi."','".$matkhau."','".$dienthoai."')";
        $sql_dangky = mysqli_query($mysqli,$sql);
        if($sql_dangky){
            $_SESSION['dangky'] = $tenkhachhang;
            header("Location:../../index.php");
        }	
	}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
     <!-- bootrap 5 -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 
     <!-- font anwsome -->
     <script src="https://kit.fontawesome.com/5644bf12f0.js" crossorigin="anonymous"></script>
	 <!-- CSS -->
	 <style>
        .body{
            margin: 0;
            padding: 0;
        }

        
        .box{
            
            height: auto;
            background-color: rgb(229, 247, 253);
        }

        h1{
            margin-top: 100px;
			margin-bottom: 50px;
            text-align: center;
            color:rgb(0, 0, 0);
        }
       
        input[type="text"],input[type="password"]{
            
            display: block;
            border: 2px solid rgba(20, 98, 244, 0.999);
            outline: none;
            border-radius: 10px;
            transition: 300ms;
        }

        .box input[type="text"]:focus,.box input[type="password"]:focus{
            border-color:greenyellow; 
        }
    
        .from-control input{
            width: 90%;
            height: 50px;
        }

        label.error{
            font-weight: 400;
            color: red;
        }
		label{
			font-weight: 500;
			line-height: 30px;
		}
    </style>
    
</head>
<body>
    
	<div class="container row">
        <div class="box col offset-3">
            <h1>NEW MEMBER</h1>
            <form class="form-horizontal" method="POST" id="register-form" autocomplete="off" onsubmit="return validateForm()">
                
				<div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="fullname">Họ và tên: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="text" name="hovaten" id="fullname" placeholder="Họ và tên..." >
                        <label class="error"></label>
                    </div>
                </div>

                
                <div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="email">Email: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="text" name="email" id="email" placeholder="Email..." >
                        <label class="error"></label>
                    </div>
                </div>

				<div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="dienthoai">SĐT: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="text" name="dienthoai" id="dienthoai" placeholder="Số điện thoại..." >
                        <label class="error"></label>
                    </div>
                </div>
                
				<div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="diachi">Địa chỉ: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="text" name="diachi" id="diachi" placeholder="Địa chỉ..." >
                        <label class="error"></label>
                    </div>
                </div>

                <div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="pwd">Mật Khẩu: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="password" name="matkhau" id="pwd" placeholder="Mật Khẩu..." >
                        <label class="error"></label>
                    </div>
                </div>

				<div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="c-pwd">Nhập lại Mật Khẩu: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="password" name="c_pwd" id="c_pwd" placeholder="Nhập lại mật khẩu..." >
                        <label class="error"></label>
                    </div>
                </div>

				

				<div class="form-group form-check mb-4 row">
					<div class="col offset-3">
                        <input type="checkbox" name="agree" id="agree">
                        <label for="agree">Bằng cách đồng ý, Có nghĩa là bạn đã chấp nhận các quy tác hoạt động của chúng tôi.</label>
                        <label class="error"></label>
					</div>
				</div>

                <div class="form-group mb-4 row">
                    <div class="col-5"></div>
                    <div class="col">
                        <button class="btn btn-primary col" type="submit" name="dangky">Đăng Ký</button>
                    </div>
                    <div class="col-5"></div>
                    
                    
                </div>

                <div class="mb-3 row ">
                    <div class="col-lg-7 col-md-9 col-sm-12 col-12 offset-1">Bạn đã có tài Khoản?</div>
                    <div class="col-lg col-md col-sm col"><a href="dangnhap.php" style="text-decoration:none">Đăng nhập ở đây!</a></div>
					<label class="error"></label>
                </div>
            </form>
        </div>
   </div> 

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

   <script>
		$(document).ready(function (){
			$("#register-form").validate({
				rules:{
					hovaten: {required: true, minlength:2},
					email: {email: true ,required:true, minlength:6},
					dienthoai: {required: true, number: true, minlength:10, maxlength:10},
					diachi: {required:true, minlength:6},
					matkhau: {required:true, minlength:6},
					c_pwd: {required: true, minlength:6, equalTo: "#pwd"},
					agree: {required:true}
				},
				messages:{
					hovaten: {required:"Họ tên không được trống", minlength:"Họ tên quá ngắn!"},
					email: {required:"Email không được trống", minlength:"email quá ngắn!", email: "Định dạng email sai!"},
					dienthoai: {required:"Số điện thoại không được trống", number: "VUi lòng chỉ nhập số", minlength:"số điện thoại phải có 10 số", maxlength:"số điện thoại phải có 10 số"},
					diachi: {required:"Địa chỉ không được trống", minlength:"Địa chỉ quá ngắn!"},
					matkhau: {required:"Mật khẩu không được bỏ trống", minlength:"mật khẩu quá ngắn"},
					c_pwd: {required:"Không được bỏ trống", minlength:"mật khẩu quá ngắn", equalTo:"Mật Khẩu chưa trùng"},
					agree: {required:"Bạn phải chấp nhận quy định của chúng tôi!"}

				}
			})
		});
   </script>

</body>
</html>