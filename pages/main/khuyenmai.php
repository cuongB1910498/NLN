<?php
    $stmt = $pdo->prepare("SELECT * FROM tbl_khuyenmai ORDER BY hethan DESC");
    $stmt->execute();
?>
<div class="row">
    <h1>Khuyến mãi hiện có: </h1>
    <?php
        while($row = $stmt->fetch()){
    ?>
    <div class="km row mb-3"><h3><a href="index.php?quanly=chitietkm&makm=<?php echo $row['makm'] ?>"><?php echo $row['tenkm'] ?></a></h3></div>

    <?php
        }
    ?>

 </div>
