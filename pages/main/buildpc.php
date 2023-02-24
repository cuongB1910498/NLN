<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo $_POST['ram'];
    }
?>
<div class="row">
    
    <form action="" method="post">

    <div class="mb-3 row offset-2">
        <label class="col-lg-2 col-md-2 col-sm-3 col-10" for="cpu">CPU:</label>
        <div class="col-lg-8 col-md-8 col-sm-7 col-10">
            <select name="cpu" id="cpu" class="form-select">
                <option value="0">chọn cpu </option>
            </select>
        </div>
    </div>

    <div class="mb-3 row offset-2">
        <label class="col-lg-2 col-md-2 col-sm-3 col-10" for="cpu">Main:</label>
        <div class="col-lg-8 col-md-8 col-sm-7 col-10">
            <select name="cpu" id="cpu" class="form-select">
                <option value="0">chọn main </option>
            </select>
        </div>
    </div>

        <?php
            $modules = $pdo->prepare("SELECT * FROM tbl_danhmuc WHERE buildpc = 1");
            $modules -> execute();
            foreach($modules as $module){
                if($module['tendanhmuc'] == 'cpu' || $module['tendanhmuc'] == 'main') continue;
                
        ?>
        <div class="mb-3 row offset-2">
            <label for="<?php echo $module['tendanhmuc'] ?>" class="col-lg-2 col-md-2 col-sm-3 col-10"><?php echo strtoupper($module['tendanhmuc']) ?>:</label>
            <div class="col-lg-8 col-md-8 col-sm-7 col-10">
                <?php
                    $cpu = $pdo->prepare(
                        "SELECT * FROM tbl_sanpham as a, tbl_danhmuc as b 
                        WHERE a.id_danhmuc = b.id_danhmuc AND tendanhmuc = :ten"
                    );
                    $cpu->execute([
                        'ten' => $module['tendanhmuc']
                    ]);
                ?>
                <select class="form-select" name="<?php echo $module['tendanhmuc'] ?>" id="<?php echo $module['tendanhmuc'] ?>">
                    <option selected value="0">Chọn <?php echo $module['tendanhmuc'] ?> ...</option>
                    <?php
                        while($row = $cpu->fetch()){
                    ?>
                    <option value="<?php echo $row['masp'] ?>"><?php echo $row['tensanpham']." - ".number_format($row['giasp'],0,',','.').'VND' ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        </div>

        <?php
            }
        ?>

        <div class="mb-3 row offset-4">
            <button class="btn btn-primary col-2" type="submit">Đặt hàng</button>
        </div>

    </form>
    
</div>