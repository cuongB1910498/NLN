
<?php 
    if(isset($_GET['action'])){
        $tam = $_GET['action'];
    }else{
        $tam = '';
    }

    if($tam=='danhmuc'){
        include("modules/quanlydanhmucsp/lietke.php");
        include("modules/quanlydanhmucsp/them.php");    
    }elseif($tam=='quanlydanhmucsanpham'){
        include("modules/quanlydanhmucsp/sua.php");
    }elseif($tam=='quanlysp'){
        include("modules/quanlysp/lietke.php");
    }elseif($tam=='themsp'){
        include("modules/quanlysp/them.php");
    }elseif($tam=='suasp'){
        include("modules/quanlysp/sua.php");
    }elseif($tam=='xemchitiet'){
        include("modules/quanlydonhang/xemchitietdon.php");
    }elseif($tam=='themtrangthai'){
        include("modules/quanlydonhang/themtrangthai.php");
    }elseif($tam == 'thembaiviet'){
        include("modules/qlbaiviet/baiviet.php");
    }elseif($tam == 'suabaiviet'){
        include("modules/qlbaiviet/sua_bv.php");
    }elseif($tam == 'xoabaiviet'){
        include("modules/qlbaiviet/xoa.php");
    }elseif($tam == 'timkiem'){
        include("modules/timkiem.php");
    }elseif($tam == "quanlydonhang"){
        include("modules/quanlydonhang/xemdonhang.php");
    }
        
    else{
        include("modules/thongke/thongke.php");
    }

?>