<!-- main -->
  
<div class="main bg-light row">
  <!-- main left -->
  <div class="dropdown col-lg-3 col-md-3 col-sm-6 col-12 p-5 justify-content-start">
    <?php 
      include("slidebar/slidebar.php")
    ?>
  </div>

  <!-- main-right -->
  <div class="main-r col-lg-9 col-md-9 col-sm-6 col-12">
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
      }
      
      else{
        include("main/index.php");
      }
        
    ?>
  </div>      
</div>


