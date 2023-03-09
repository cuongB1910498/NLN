<?php
    include("../../../admincp/config/conect.php");
    if(isset($_POST['cpu'])){
        $P_cpu = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
        $P_cpu->execute(['id'=>$_POST['cpu']]);
        $cpu = $P_cpu->fetch()
?>
    <p class="add"><?php echo $cpu['giasp'] ?></p>

<?php 
    }
    if(isset($_POST['ram'])){
        $P_ram = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
        $P_ram->execute(['id'=>$_POST['ram']]);
        $ram = $P_ram->fetch()
?>
    <p class="add"><?php echo $ram['giasp'] ?></p>

<?php 
    } 
    if(isset($_POST['main'])){
        $P_main = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
        $P_main->execute(['id'=>$_POST['main']]);
        $ram = $P_main->fetch()
?>
    <p class="add"><?php echo $ram['giasp'] ?></p>
<?php  
    }
    if(isset($_POST['vga'])){
        $P_vga = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
        $P_vga->execute(['id'=>$_POST['vga']]);
        $ram = $P_vga->fetch()
?>

    <p class="add"><?php echo $ram['giasp'] ?></p>
<?php  
    }
    if(isset($_POST['psu'])){
        $P_psu = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
        $P_psu->execute(['id'=>$_POST['psu']]);
        $ram = $P_psu->fetch()
?>
    <p class="add"><?php echo $ram['giasp'] ?></p>
<?php  
    }
    if(isset($_POST['ssd'])){
        $P_ssd = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
        $P_ssd->execute(['id'=>$_POST['ssd']]);
        $ram = $P_ssd->fetch()
?>
    <p class="add"><?php echo $ram['giasp'] ?></p>
<?php  
    }
    if(isset($_POST['case'])){
        $P_case = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
        $P_case->execute(['id'=>$_POST['case']]);
        $ram = $P_case->fetch()
?>

<p class="add"><?php echo $ram['giasp'] ?></p>
<?php  
    }
?>