<?php
    $sql = "SELECT * FROM tbl_baiviet WHERE id_baiviet = '".$_GET['id']."' ";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    //
?>
<div class="chitiet">
    <h3 class="tieude"><?php echo $row['tieude'] ?></h3>
    <div class="row">
        <p><?php echo $row['noidung'] ?></p>
    </div>

    <div class="row">
        <img class="img" src="admincp/modules/qlbaiviet/uploads/<?php echo $row['anh_mh'] ?>" >
    </div>

    <div class="row">
        <p>Thẻ: <?php echo $row['tag'] ?></p>
    </div>
</div>