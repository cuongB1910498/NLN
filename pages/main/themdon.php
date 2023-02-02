<?php
    
    $id_dangky = $_SESSION['dangnhap'];
    //echo $_POST['diachi'];
    
    //lấy id địa chỉ bằng cách tách chuỗi từ chuỗi bên trang vanchuyen.php
    $tachdiachi = explode(' , ', $_POST['diachi']);
    

    $tendiachi = $tachdiachi[0];
    //echo "<br>".$tendiachi;
    // $sql = "SELECT * FROM tbl_diachi WHERE tendiachi = '".$tendiachi."' AND id_dangky = '".$id_dangky."' ";
    // $query = mysqli_query($mysqli, $sql);
    $query = $pdo->prepare(
        "SELECT * FROM tbl_diachi WHERE tendiachi = :dc AND id_dangky = :id"
    );
    $query->execute([
        'dc' => $tendiachi,
        'id' => $id_dangky
    ]);
    $row = $query->fetch();
    $id_diachi = $row['id_diachi'];
    //echo "<br>".$id_diachi;


    
    $madon = time();
    // $sql_themdon = "INSERT INTO tbl_donhang(id_dangky, madon, id_diachi) VALUE ('".$id_dangky."', '".$madon."', '".$id_diachi."')";
    // $query_themdon = mysqli_query($mysqli, $sql_themdon);
    $query_themdon = $pdo->prepare(
        "INSERT INTO tbl_donhang(id_dangky, madon, id_diachi) 
            VALUE (:id, :md, :dc)"
    );
    $query_themdon->execute([
        'id' => $id_dangky,
        'md' => $madon,
        'dc' => $id_diachi
    ]);


    $id_trangthai = 1;
    $ghichu = "";
    // $sql_themcttt = "INSERT INTO tbl_chitiet_tt(madon, id_trangthai, ghichu)
    // VALUE ('".$madon."',$id_trangthai, '".$ghichu."')";
    //echo $sql_themcttt;
    // $query_themcttt = mysqli_query($mysqli, $sql_themcttt);
    $query_themctt = $pdo->prepare(
        "INSERT INTO tbl_chitiet_tt(madon, id_trangthai, ghichu)
            VALUE (:md, :tt, :gc)"
    );
    $query_themctt->execute([
        'md' => $madon,
        'tt' => $id_trangthai,
        'gc' => $ghichu
    ]);
    
    foreach($_SESSION['cart'] as $row){
        // $sql_chitietdon = "INSERT INTO tbl_chitietdon(madon, id_sanpham, sl_mua) 
        // VALUE ('".$madon."', '".$row['id']."', '".$row['soluong']."')";
        // cập nhật đơn hàng: số lượng  = số lượng - sl mua
        // $sql_trusl="UPDATE tbl_sanpham SET soluong = soluong - '".$row['soluong']."' WHERE id_sanpham = '".$row['id']."'";
        // $sql_trusl = mysqli_query($mysqli, $sql_trusl);
        // $query_chitietdon = mysqli_query($mysqli, $sql_chitietdon);
        $query_chitietdon = $pdo->prepare(
            "INSERT INTO tbl_chitietdon(madon, id_sanpham, sl_mua) 
                VALUE (:md, :id, :sl)"
        );
        $query_chitietdon->execute([
            'md' => $madon,
            'id' => $row['id'],
            'sl' => $row['soluong']
        ]);

        $query_trusl = $pdo->prepare(
            "UPDATE tbl_sanpham SET soluong = soluong - :sl WHERE id_sanpham = :id"
        );
        $query_trusl->execute([
            'sl' => $row['soluong'],
            'id' => $row['id']
        ]);

    }
    
    
    if($query_themdon && $query_chitietdon){
        unset($_SESSION['cart']);
        header("Location: index.php?quanly=lichsudon");
        
    }
?>