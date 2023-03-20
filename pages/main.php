<!-- main -->

<div class="main ">
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
        include("main/baiviet.php");
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
      }elseif($tam == 'chitietdon'){
        include("main/chitietdon.php");
      }elseif($tam == 'qltaikhoan'){
        include("main/qltaikhoan.php");
      }elseif($tam== 'diachi'){
        include("main/quanly_diachi/diachi.php");
      }elseif($tam == 'xoadiachi'){
        include("main/quanly_diachi/xoadiachi.php");
      }elseif($tam == 'themdiachi'){
        include("main/quanly_diachi/themdiachi.php");
      }elseif($tam == 'suadiachi'){
        include("main/quanly_diachi/suadiachi.php");
      }elseif ($tam == 'tpvc'){
        include("main/vanchuyen.php");
      }elseif ($tam == 'chitiet_bv'){
        include("main/chitiet_bv.php");
      }elseif( $tam =='buildpc'){
        include("main/build_pc/buildpc.php");
      }elseif( $tam =='dathangpc'){
        include("main/build_pc/add_order.php");
      }elseif ($tam == 'chitietkm'){
        include("main/chitietkm.php");
      }
        
        
      else{
        include("main/index.php");
      }
          
      ?>
  </div>  


</div>