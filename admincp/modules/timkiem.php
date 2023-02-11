<?php
    $key = $_POST['key'];
    $sql = "SELECT * FROM tbl_sanpham WHERE tensanpham LIKE :ten";
    $query = $pdo->prepare($sql);
    $query->execute([
        'ten' => '%'.$key.'%'
    ]);
?>

<p>Kết quả cho từ khóa: <?php echo $_POST['key']; ?></p>
<div class="row offset-lg-1 offset-1" id="hienthi">
    <?php
        $i=0;
        while($row = $query->fetch()){
    ?>
    <div class="card col-lg-3 col-md-4 col-sm-6 col-12" style="width:300px" id="card">
        
        <div class="card-title">
                <img class="card-img-top" id="img" src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" alt="Card image"> 
        </div>
        <div class="card-body">
            <h4 class="card-title"><?php echo $row['tensanpham'] ?></h4>
            <p class="card-text">Giá: <?php echo number_format($row['giasp'],0,',','.').'vnđ'?></p>
        </div>
        <div class="row mb-3 offset-2">
            <a href="index.php?action=quanlysp&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>" class="themgiohang btn btn-warning col-4" name="themgiohang" type="submit" value="Thêm giỏ hàng">Sửa</a>
            <div class="col-2"></div>
            <!-- del btn -->
            <button class="themgiohang btn btn-danger col-4" type="button" data-bs-toggle="modal" data-bs-target="#modal<?php echo $i ?>">Xóa</button>
            <!-- modal -->
            <div class="modal fade" id="modal<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chú ý</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    hãy suy nghĩ cho thật kỹ xóa là không thể khôi phục
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <a href="modules/quanlysp/xuly.php?idsanpham=<?php echo $row['id_sanpham'] ?>" type="submit" class="btn btn-danger">Xóa</a>
                </div>
                </div>
            </div>
        </div>  
    </div>
        
    </div>
    
    <?php
            if(isset($row)) $i++;
        }
        if($i == 0){
    ?>
    <h2>Không có kết quả tìm kiếm phù hợp </h2>
    <?php
        }
    ?>
</div>
