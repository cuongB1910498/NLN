<!-- main -->

<div class="main bg-light">
  <div class="main-cont">
    <?php
      if(isset($_GET['quanly'])){
        $tam = $_GET['quanly'];
      }else{
        $tam = '';
      }
      if($tam =='danhmucsanpham'){
        include("main/danhmuc.php");
      }elseif($tam=='tintuc'){
        include("main/tintuc.php");
      }elseif($tam=='khuyenmai'){
        include("main/khuyenmai.php");
      }elseif($tam=='lienhe'){
        include("main/lienhe.php");
      }elseif($tam=='sanpham'){
        include("main/sanpham.php");
      }elseif($tam=='giohang'){
        include("main/giohang.php");
      }elseif($tam=='timkiem'){
        include("main/timkiem.php");
      }elseif($tam=='themdon'){
        include("main/themdon.php");
      }elseif($tam == 'lichsudon'){
        include("main/lichsudon.php");
      }
      
        
      else{
        include("main/index.php");
      }
          
      ?>
  </div>  


</div>