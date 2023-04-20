<?php
    $makm = $_GET['khuyenmai'];
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
        "INSERT INTO tbl_donhang(id_dangky, madon, id_diachi, makm) 
            VALUE (:id, :md, :dc, :km)"
    );
    $query_themdon->execute([
        'id' => $id_dangky,
        'md' => $madon,
        'dc' => $id_diachi,
        'km' => $makm
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
        
        $query_chitietdon = $pdo->prepare(
            "INSERT INTO tbl_chitietdon(madon, id_sanpham, sl_mua) 
                VALUE (:md, :id, :sl)"
        );
        $query_chitietdon->execute([
            'md' => $madon,
            'id' => $row['id'],
            'sl' => $row['soluong']
        ]);

        // cập nhật lại tbl_sanpham
        $query_trusl = $pdo->prepare(
            "UPDATE tbl_sanpham SET soluong = soluong - :sl WHERE id_sanpham = :id"
        );
        $query_trusl->execute([
            'sl' => $row['soluong'],
            'id' => $row['id']
        ]);

        $status = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
        $status -> execute([
            'id'=> $row['id']
        ]);
        $check = $status->fetch();
        if($check['soluong'] <= 0){
            $hide = $pdo->prepare(
                "UPDATE tbl_sanpham SET tinhtrang = 0 WHERE id_sanpham = '".$check['id_sanpham']."'"
            );
            $hide->execute();
        }

        //cap nhat so lieu thong ke trang thai don
        $update_status = $pdo->prepare("UPDATE tbl_trangthaidon SET solieu=solieu+1 WHERE id_trangthai = 1");
        $update_status->execute();

    }
    
    
    if($query_themdon && $query_chitietdon){
        unset($_SESSION['cart']);
        header("Location: index.php?quanly=lichsudon");
        
    }
?>