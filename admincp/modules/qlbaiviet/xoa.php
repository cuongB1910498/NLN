<?php
    $id_baiviet = $_GET['id'];
    // xóa ảnh trên server
    // $sql_xoaanh = "SELECT * FROM tbl_baiviet WHERE id_baiviet = $id_baiviet";
    // $query_xoaanh = mysqli_query($mysqli, $sql_xoaanh);
    // $row = mysqli_fetch_array($query_xoaanh);

    $r_img = $pdo->prepare(
        "SELECT * FROM tbl_baiviet WHERE id_baiviet = :id"
    );
    $r_img->execute([
        'id' => $id_baiviet
    ]);

    $row = $r_img->fetch();
    unlink('modules/qlbaiviet/uploads/'.$row['anh_mh']);
    
    // xóa trên csdl
    // $sql_xoa = "DELETE FROM tbl_baiviet WHERE id_baiviet = '".$id_baiviet."' ";
    // $query_xoa = mysqli_query($mysqli, $sql_xoa);
    $stmt = $pdo->prepare(
        "DELETE FROM tbl_baiviet WHERE id_baiviet = :id"
    );

    $stmt->execute([
        'id' => $id_baiviet
    ]);
    header("Location: index.php?action=thembaiviet");
?>