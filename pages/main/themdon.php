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
    $trangthai = "DA DAC HANG";
    $madon = time();
    $sql_themdon = "INSERT INTO tbl_donhang(id_dangky, madon, trangthai) VALUE ('".$id_dangky."', '".$madon."', '".$trangthai."')";
    $query_themdon = mysqli_query($mysqli, $sql_themdon);
    
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