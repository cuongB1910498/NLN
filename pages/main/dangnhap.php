<?php
	session_start();
	//include("../../admincp/config/config.php");
    include("../../admincp/config/conect.php");
	if(isset($_POST['dangnhap'])){
		$email = $_POST['email'];
		$matkhau = md5($_POST['password']);
		// $sql = "SELECT * FROM tbl_dangky WHERE email='".$email."' AND matkhau='".$matkhau."' LIMIT 1";
		// $row = mysqli_query($mysqli,$sql);
        // $rows = mysqli_fetch_array($row);
        $row = $pdo->prepare(
            "SELECT * FROM tbl_dangky WHERE email= :mail AND matkhau= :mk LIMIT 1"
        );
        $row->execute([
            'mail' => $email,
            'mk' => $matkhau
        ]);
        $rows = $row->fetch();
		$count = $row->rowCount();
		if($count>0){
			$_SESSION['dangnhap'] = $rows['id_dangky'];
			header("Location:../../index.php");
		}else{
			echo '<script>alert("Tài khoản hoặc Mật khẩu không đúng,vui lòng nhập lại.");</script>';
			
		}
	} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
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
            width: 20%;
            width: 50%;
            height: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgb(229, 247, 253);
        }

        h1{
            margin: 50px auto;
            text-align: center;
            color:rgb(0, 0, 0);
        }
       
        input[type="text"],input[type="password"]{
            
            display: block;
            border: 2px solid rgba(20, 98, 244, 0.999);
            outline: none;      
            transition: 300ms;
        }

        .box input[type="text"]:focus,.box input[type="password"]:focus{
            border-color:greenyellow; 
        }
    
        input{
            width: 90%;
            height: 50px;
        }
        label.error{
            font-weight: 400;
            color: red;
        }
    </style>
</head>
<body>
   <div class="container">
        <div class="box">
            <h1>LOGIN</h1>
            <form class="form-horizontal" method="post" id="login-form">
                
                <div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="usn">Email: </label>
                    <div class="from-control col-lg-8 col-md-8 col-sm-12 col-12 offset-1">
                        <input class="" type="text" name="email" id="usn" placeholder="Enter Username..." >
                        <label class="error"></label>
                    </div>
                </div>

                <div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="pwd">Password: </label>
                    <div class="from-control col-lg-8 col-md-8 col-sm-12 col-12 offset-1">
                        <input class="" type="password" name="password" id="pwd" placeholder="Enter Password..." >
                        <label class="error"></label>
                    </div>
                </div>

                
                <div class="form-group mb-4 row">
                    <div class="col-5"></div>
                    <div class="col">
                        <button class="btn btn-primary col" type="submit" name="dangnhap">SUBMIT</button>
                    </div>
                    <div class="col-5"></div>
                      
                </div>

                <div class="mb-3 row ">
                    <div class="col-lg-7 col-md-9 col-sm-12 col-12 offset-1">Bạn chưa có tài Khoản?</div>
                    <div class="col-lg col-md col-sm col"><a href="dangky.php" style="text-decoration:none">Đăng Ký tại đây</a></div>

                </div>
            </form>
        </div>
   </div> 
   <!-- Jquery -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

   <script>
        $(document).ready(function (){
            $("#login-form").validate({
                rules:{
                    email: {email: true, required:true},
                    password: {required:true, minlength:2}
                },
                messages:{
                    email: {email:"Vui lòng nhập đúng định dạng emnai", required:"Email không được bỏ trống"},
                    password: {required:"Bạn chưa nhập Mật Khẩu", minlength:"Mật Khẩu phải từ 2 ký tự trở lên"}
                },
                
            });
        });
   </script>
</body>
</html>