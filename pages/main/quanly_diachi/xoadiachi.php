<?php
    $id_diachi = $_GET['id'];
    //echo $id_diachi;
    $sql_xoa = "DELETE from tbl_diachi WHERE id_diachi = $id_diachi";
    $query_xoa=mysqli_query($mysqli, $sql_xoa);
    header("Location:index.php?quanly=diachi");
?>