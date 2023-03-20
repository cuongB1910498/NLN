<?php
    $stmt = $pdo->prepare("SELECT * FROM tbl_khuyenmai WHERE makm = '".$_GET['makm']."'");
    $stmt -> execute();
    $row = $stmt->fetch();
?>

<div class="row">
    <h2><?php echo $row['tenkm'] ?></h2>
    <div><?php echo $row['nd'] ?></div>
    <p>giảm: <?php echo number_format($row['giakm'],0,',','.').' VND' ?></p>
    <p><?php echo date("d/m/Y",strtotime($row['hethan'])) ?></p>
</div>