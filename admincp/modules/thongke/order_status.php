<?php

    include("../../config/conect.php");

    $stmt = $pdo->prepare("SELECT * FROM tbl_trangthaidon");
    $stmt -> execute();
    while($row = $stmt->fetch()){
        $Orders[]= array(
            'y' => $row['tentrangthai'],
            'a' => $row['solieu'],
        );
    }
    echo $order = json_encode($Orders);
?>