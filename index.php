<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANG CHU</title>
    
    <!-- bootrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- font anwsome -->
    <script src="https://kit.fontawesome.com/5644bf12f0.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
</head>
<body>

    <div class="container-fluid">
        <?php 
            session_start();
            ob_start();
            include("admincp/config/conect.php");
            include("pages/header.php");
            include("pages/menu.php");
            include("pages/main.php");
            include("pages/footer.php");
        ?> 
    </div>

    <?php 
        if(isset($_SESSION['dangky'])){
            echo '<script>alert("Đăng Ký thành công");</script>';
            unset($_SESSION['dangky']);
        }
    ?>
    </script>
    <script src="js/script.js"></script>
    <script src="pages/main/build_pc/ajax.js"></script>

    <script>
        $("#tinhTong").click(function(){
            var sum = 0;
            var elements = document.querySelectorAll('p.add');
            for (var i = 0; i < elements.length; i++) {
                sum += parseInt(elements[i].textContent);
            }
            var sumStr = sum.toLocaleString();
            document.getElementById('ketQua').innerHTML = sumStr + " VND";
        })
    </script>
</body>
</html>