<?php
    $id_baiviet = $_GET['id'];
    // xóa ảnh trên server
    $sql_xoaanh = "SELECT * FROM tbl_baiviet WHERE id_baiviet = $id_baiviet";
    $query_xoaanh = mysqli_query($mysqli, $sql_xoaanh);
    $row = mysqli_fetch_array($query_xoaanh);

    unlink('modules/qlbaiviet/uploads/'.$row['anh_mh']);
    
    // xóa trên csdl
    $sql_xoa = "DELETE FROM tbl_baiviet WHERE id_baiviet = '".$id_baiviet."' ";
    $query_xoa = mysqli_query($mysqli, $sql_xoa);
    header("Location: index.php?action=quanlybaiviet&query=thembaiviet");
?>