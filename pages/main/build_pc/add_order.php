<?php
    $id_dangky = $_SESSION['dangnhap'];
    $id_diachi = $_POST['diachi'];
    $madon = time();

    $pc = array($_POST['cpu'], $_POST['main'], $_POST['61'], $_POST['62'], $_POST['63'], $_POST['64'], $_POST[65]);


    $query_themdon = $pdo->prepare(
        "INSERT INTO tbl_donhang(id_dangky, madon, id_diachi) 
            VALUE (:id, :md, :dc)"
    );
    $query_themdon->execute([
        'id' => $id_dangky,
        'md' => $madon,
        'dc' => $id_diachi
    ]);

    $query_themctt = $pdo->prepare(
        "INSERT INTO tbl_chitiet_tt(madon, id_trangthai, ghichu)
            VALUE (:md, :tt, :gc)"
    );
    $query_themctt->execute([
        'md' => $madon,
        'tt' => 1,
        'gc' => ''
    ]);


    foreach($pc as $key){
        $query_chitietdon = $pdo->prepare(
            "INSERT INTO tbl_chitietdon(madon, id_sanpham, sl_mua) 
                VALUE (:md, :id, :sl)"
        );
        $query_chitietdon->execute([
            'md' => $madon,
            'id' => $key,
            'sl' => 1
        ]);

        // cập nhật lại tbl_sanpham
        $query_trusl = $pdo->prepare(
            "UPDATE tbl_sanpham SET soluong = soluong - :sl WHERE id_sanpham = :id"
        );
        $query_trusl->execute([
            'sl' => 1,
            'id' => $key
        ]);
    }

?>