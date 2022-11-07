
<?php 
    if(isset($_GET['action']) && isset($_GET['query'])){
        $tam = $_GET['action'];
        $query = $_GET['query'];
    }else{
        $tam = '';
        $query =''; 
    }

    if($tam=='quanlydanhmucsanpham' && $query=='them'){
        include("modules/quanlydanhmucsp/them.php");
        include("modules/quanlydanhmucsp/lietke.php");
            
    }elseif($tam=='quanlydanhmucsanpham' && $query=='sua'){
        include("modules/quanlydanhmucsp/sua.php");
    }elseif($tam=='quanlysp' && $query=='them'){
        include("modules/quanlysp/them.php");
        include("modules/quanlysp/lietke.php");
    }elseif($tam=='quanlysp' && $query=='sua'){
        include("modules/quanlysp/sua.php");
    }elseif($tam=='quanlysp' && $query=='xoa'){
        include("modules/quanlysp/xoa.php");
    }elseif($tam == 'quanlydonhang' && $query == 'xemdon'){
        include("modules/quanlydonhang/xemdonhang.php");
    }elseif($tam == 'quanlydonhang' && $query == 'xemchitiet'){
        include("modules/quanlydonhang/xemchitietdon.php");
    }elseif($tam == 'quanlydonhang' && $query == 'themtrangthai'){
        include("modules/quanlydonhang/themtrangthai.php");
    }
        
    else{
        include("dashboard.php");
    }

?>

