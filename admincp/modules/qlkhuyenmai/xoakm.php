<?php
    $stmt = $pdo->prepare("DELETE FROM tbl_khuyenmai WHERE makm = '".$_GET['makm']."'");
    $stmt -> execute();
    header("Location: index.php?action=themkhuyenmai");
?>