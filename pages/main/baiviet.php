<?php
    $sql = "SELECT * FROM tbl_baiviet order by ngaytao DESC";
    $query = mysqli_query($mysqli, $sql);

?>
<div class="baiviet">
    <h1 id="baiviet_h1">CÁC BÀI VIẾT: </h1>
    <div class="row">
        
       
            <?php
                while ($row = mysqli_fetch_array($query)){

            ?>
            
            <div class="list row alert-success offset-2" style="width: 60%;">
                <div class="col"><a href="index.php?quanly=chitiet_bv&id=<?php echo $row['id_baiviet'] ?>"><?php echo $row['tieude'] ?></a></div>
                <div class="col" id="ngaytao"><?php echo $row['ngaytao'] ?></div>
            </div>

            <?php
                }
            ?>
            
        
    </div>
</div>