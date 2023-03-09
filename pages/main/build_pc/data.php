<?php
    session_start();
    include("../../../admincp/config/conect.php"); 
    $id = $_POST['id'];
    if($id == '1'){
        $cpu = $pdo -> prepare(
            "SELECT * FROM tbL_sanpham as a, tbl_danhmuc as b
            WHERE a.id_danhmuc = b.id_danhmuc AND nentang = 'intel'
            AND tendanhmuc = 'cpu' "
        );
        $cpu->execute();
        $main = $pdo->prepare(
            "SELECT * FROM tbl_sanpham as a, tbl_danhmuc as b
            WHERE a.id_danhmuc = b.id_danhmuc AND nentang = 'intel'
            AND tendanhmuc = 'main'"
        );
        $main->execute();

?>

    <div class="row mb-3 offset-lg-2">
        <label class="col-lg-2 col-md-2 col-sm-3 col-10" for="cpu">CPU:</label>
        <div class="col-lg-5 col-md-8 col-sm-7 col-10">
            <select name="cpu" id="cpu" class="cpu form-select">
                <option value=""> Chọn CPU Intel</option>
                <?php 
                    while($row = $cpu->fetch()){
                ?>
                    
                    <option value="<?php echo $row['id_sanpham'] ?>"> <?php echo $row['tensanpham']." BẢO HÀNH CHÍNH HÃNG ".$row['giasp'] ?> </option>
                <?php 
                    }
                ?>
            </select>
        </div>
        <div class="cpu-pri col-1"></div>
    </div>

    <div class="row offset-lg-2">
        <label class="col-lg-2 col-md-2 col-sm-3 col-10" for="main">Main:</label>
        <div class="col-lg-5 col-md-8 col-sm-7 col-10">
            <select name="main" id="main" class="form-select">
                <option value=""> Chọn Main:</option>
                <?php 
                    while($row = $main->fetch()){
                ?>
                    
                    <option value="<?php echo $row['id_sanpham'] ?>"> <?php echo $row['tensanpham']." BẢO HÀNH CHÍNH HÃNG ".$row['giasp'] ?> </option>
                <?php 
                    }
                ?>
            </select>
        </div>
        <div class="main-pri col-1"></div>
    </div>

    

<?php 
    }elseif($id == 2){
        $cpu = $pdo->prepare(
            "SELECT * FROM tbl_sanpham as a, tbl_danhmuc as b
            WHERE a.id_danhmuc = b.id_danhmuc AND nentang = 'amd'
            AND tendanhmuc = 'cpu'"
        ); 
        $cpu->execute();

        $main = $pdo->prepare(
            "SELECT * FROM tbl_sanpham as a, tbl_danhmuc as b
            WHERE a.id_danhmuc = b.id_danhmuc AND nentang = 'amd'
            AND tendanhmuc = 'main'"
        );
        $main->execute();
?>
    <div class="row mb-3 offset-lg-2">
        <label class="col-lg-2 col-md-2 col-sm-3 col-10" for="cpu">CPU:</label>
        <div class="col-lg-5 col-md-8 col-sm-7 col-10">
            <select name="cpu" id="cpu" class="cpu form-select">
                <option value="">Chọn cpu AMD </option>

                <?php
                    while($row = $cpu->fetch()){
                        $giasp = $row['giasp']
                ?>
                <option value="<?php echo $row['id_sanpham'] ?>"><?php echo $row['tensanpham']." BẢO HÀNH CHÍNH HÃNG ".$row['giasp']?> </option>
                <?php }?>
            </select>
        </div>
        <div class="cpu-pri col-1">1</div>
    </div>

    <div class="row offset-lg-2">
        <label class="col-lg-2 col-md-2 col-sm-3 col-10" for="main">Main:</label>
        <div class="col-lg-5 col-md-8 col-sm-7 col-10">
            <select name="main" id="main" class="form-select">
                <option value=""> Chọn Main:</option>
                <?php 
                    while($row = $main->fetch()){
                ?>
                    
                    <option value="<?php echo $row['id_sanpham'] ?>"> <?php echo $row['tensanpham']." BẢO HÀNH CHÍNH HÃNG ".$row['giasp'] ?> </option>
                <?php 
                    }
                ?>
            </select>
        </div>
        <div class="main-pri col-1"></div>
    </div>
    

<?php } ?>

