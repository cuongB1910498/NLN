<?php
    $stmt = $pdo->prepare("SELECT * FROM tbl_khuyenmai ORDER BY hethan DESC");
    $stmt->execute();
?>
<div class="khuyenmai">
    <div class="row">
        <h1>Khuyến mãi hiện có: </h1>
        <?php
            while($row = $stmt->fetch()){
        ?>

        <div class="km row alert-success mb-3">
            <div class="col-2"></div>
            <div class="col">
                <a href="index.php?quanly=chitietkm&makm=<?php echo $row['makm'] ?>"><?php echo $row['tenkm'] ?></a>
            </div>
            <div class="col">
                <p>Hết hạn: <?php echo $row['hethan'] ?></p>
            </div>
        </div>

        <?php
            }
        ?>

    </div>
</div>
