
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
    }
    
    elseif($tam == 'timkiem'){
        include("modules/timkiem.php");
    }
        
    else{
        include("modules/quanlydonhang/xemdonhang.php");
    }

?>