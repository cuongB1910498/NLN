<?php
    $id_diachi = $_GET['id'];
    //echo $id_diachi;
    $sql_xoa = "DELETE from tbl_diachi WHERE id_diachi =:id";
    $query_xoa=$pdo->prepare($sql_xoa);
    $query_xoa->execute(['id'=>$id_diachi]);
    header("Location:index.php?quanly=diachi");
?>