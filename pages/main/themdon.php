<?php
    // echo $_SESSION['dangnhap'];
    // echo "<hr>";
    // foreach($_SESSION['cart'] as $row){
    //     echo "id sp: ".$row['id'];
    //     echo " | ";
    //     echo "ten sp: ".$row['tensanpham'];
    //     echo " | ";
    //     echo "sl mua: ".$row['soluong'];
    //     echo " | ";
    //     echo "gia sp: ".$row['giasp'];
    //     echo "<hr>";
    // }
    
    $id_dangky = $_SESSION['dangnhap'];
    
    $madon = time();
    $sql_themdon = "INSERT INTO tbl_donhang(id_dangky, madon) VALUE ('".$id_dangky."', '".$madon."')";
    $query_themdon = mysqli_query($mysqli, $sql_themdon);


    $id_trangthai = 1;
    $ghichu = "";
    $sql_themcttt = "INSERT INTO tbl_chitiet_tt(madon, id_trangthai, ghichu)
    VALUE ('".$madon."',$id_trangthai, '".$ghichu."')";
    echo $sql_themcttt;
    $query_themcttt = mysqli_query($mysqli, $sql_themcttt);
    
    foreach($_SESSION['cart'] as $row){
        $sql_chitietdon = "INSERT INTO tbl_chitietdon(madon, id_sanpham, sl_mua) VALUE ('".$madon."', '".$row['id']."', '".$row['soluong']."')";
        $query_chitietdon = mysqli_query($mysqli, $sql_chitietdon);
    }
    
    
    if($query_themdon && $query_chitietdon){
        echo "them thanh cong";
        unset($_SESSION['cart']);
        header("Location:index.php?quanly=lichsudon");
        
    }
?>