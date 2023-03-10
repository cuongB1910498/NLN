<?php
    session_start();
	//include("../../admincp/config/config.php");
    include("../../admincp/config/conect.php");
    $found = false;
	if(isset($_POST['dangky'])) {
		$tenkhachhang = $_POST['hovaten'];
		$email = $_POST['email'];
        //check email
        // $sql_mailcheck = "SELECT email FROM tbl_dangky";
        // $sql_check = mysqli_query($mysqli, $sql_mailcheck);
        $sql_check = $pdo->prepare(
            "SELECT email FROM tbl_dangky"
        );
        $sql_check->execute();
        $i=0;
        
        while($row = $sql_check->fetch()){
            if($row['email'] == $email){
                $found = true;
                break;
            }else{
                $found = false;
            }
            $i++;
        }
                        
		$dienthoai = $_POST['dienthoai'];
		$matkhau = md5($_POST['matkhau']);
		//$diachi = $_POST['diachi'];
        
        if($found == false){
            // $sql = "INSERT INTO tbl_dangky(tenkhachhang,email,matkhau,dienthoai) 
            // VALUE('".$tenkhachhang."','".$email."','".$matkhau."','".$dienthoai."')";
            // $sql_dangky = mysqli_query($mysqli,$sql);
            $sql_dangky = $pdo->prepare(
                "INSERT INTO tbl_dangky(tenkhachhang,email,matkhau,dienthoai) 
                    VALUE(:ten, :mail, :mk, :dt)"
            );
            $sql_dangky->execute([
                'ten' => $tenkhachhang,
                'mail' => $email,
                'mk' => $matkhau,
                'dt' => $dienthoai
            ]);
            if($sql_dangky){
                $_SESSION['dangky'] = $tenkhachhang;
                header("Location:../../index.php");
            }
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
            <form class="form-horizontal" method="POST" id="register-form" autocomplete="off" onsubmit="return validateEmail()">
                
				<div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="fullname">H??? v?? t??n: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="text" name="hovaten" id="fullname" placeholder="H??? v?? t??n..." >
                        <label class="error"></label>
                    </div>
                </div>

                
                <div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="email">Email: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="text" name="email" id="email" placeholder="Email..." >
                        <?php 
                        if ($found == true){
                            
                        
                        ?>
                        <label class="error">Email ???? c?? ng?????i s??? d???ng!!</label>
                        
                        <?php } ?>

                    </div>
                </div>

				<div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="dienthoai">S??T: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="text" name="dienthoai" id="dienthoai" placeholder="S??? ??i???n tho???i..." >
                        <label class="error"></label>
                    </div>
                </div>
              
                <div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="pwd">M???t Kh???u: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="password" name="matkhau" id="pwd" placeholder="M???t Kh???u..." >
                        <label class="error"></label>
                    </div>
                </div>

				<div class="form-group mb-4 row">
                    <label class="col-lg-2 col-md-3 col-sm-12 col-12 offset-1" for="c-pwd">Nh???p l???i M???t Kh???u: </label>
                    <div class="from-control col-lg-9 col-md-9 col-sm-12 col-12">
                        <input class="" type="password" name="c_pwd" id="c_pwd" placeholder="Nh???p l???i m???t kh???u..." >
                        <label class="error"></label>
                    </div>
                </div>

				

				<div class="form-group form-check mb-4 row">
					<div class="col offset-3">
                        <input type="checkbox" name="agree" id="agree">
                        <label for="agree">B???ng c??ch ?????ng ??, C?? ngh??a l?? b???n ???? ch???p nh???n c??c quy t??c ho???t ?????ng c???a ch??ng t??i.</label>
                        <label class="error"></label>
					</div>
				</div>

                <div class="form-group mb-4 row">
                    <div class="col-5"></div>
                    <div class="col">
                        <button class="btn btn-primary col" type="submit" name="dangky">????ng K??</button>
                    </div>
                    <div class="col-5"></div>
                    
                    
                </div>

                <div class="mb-3 row ">
                    <div class="col-lg-7 col-md-9 col-sm-12 col-12 offset-1">B???n ???? c?? t??i Kho???n?</div>
                    <div class="col-lg col-md col-sm col"><a href="dangnhap.php" style="text-decoration:none">????ng nh???p ??? ????y!</a></div>
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
					matkhau: {required:true, minlength:6},
					c_pwd: {required: true, minlength:6, equalTo: "#pwd"},
					agree: {required:true}
				},
				messages:{
					hovaten: {required:"H??? t??n kh??ng ???????c tr???ng", minlength:"H??? t??n qu?? ng???n!"},
					email: {required:"Email kh??ng ???????c tr???ng", minlength:"email qu?? ng???n!", email: "?????nh d???ng email sai!"},
					dienthoai: {required:"S??? ??i???n tho???i kh??ng ???????c tr???ng", number: "VUi l??ng ch??? nh???p s???", minlength:"s??? ??i???n tho???i ph???i c?? 10 s???", maxlength:"s??? ??i???n tho???i ph???i c?? 10 s???"},
					matkhau: {required:"M???t kh???u kh??ng ???????c b??? tr???ng", minlength:"m???t kh???u qu?? ng???n"},
					c_pwd: {required:"Kh??ng ???????c b??? tr???ng", minlength:"m???t kh???u qu?? ng???n", equalTo:"M???t Kh???u ch??a tr??ng"},
					agree: {required:"B???n ph???i ch???p nh???n quy ?????nh c???a ch??ng t??i!"}

				}
			})
		});
   </script>

</body>
</html>