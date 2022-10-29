<div class="diachi">
    <h1>ĐỊA CHỈ GIAO HÀNG CỦA TÔI</h1>
<?php 
    $id_dangky = $_SESSION['dangnhap'];
    $sql = "SELECT * from tbl_diachi as a, tbl_tinh as b 
    WHERE id_dangky = $id_dangky 
    AND a.id_tinh = b.id_tinh";
    // echo $sql;
    $query = mysqli_query($mysqli, $sql);
?>

<!-- Xóa địa chỉ giao hàng -->
<?php
    if(isset($_GET['xoa'])){
        $id_diachi = $GET['id'];
        echo $id_diachi;
    }
?>
    <table class="diachi mb-3">
        <tr>
            <th class="tbl_stt">STT</th>
            <th class="tbl_tendiachi">Tên địa chỉ</th>
            <th class="tbl_diachi">Địa chỉ</th>
            <th class="tbl_tinh">Tỉnh</th>
            <th class="tbl_thaotac">Thao tác</th>
        </tr>
        <?php
            $i = 1;
            while($row = mysqli_fetch_array($query)){
                 
            
        ?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row['tendiachi'] ?></td>
            <td><?php echo $row['diachi'] ?></td>
            <td><?php echo $row['tentinh'] ?></td>
            <td>
                <button class="btn btn-warning" type="button"><a href="index.php?quanly=suadiachi&id=<?php echo $row['id_diachi'] ?>">Sửa</a></button> 
                <button class="btn btn-danger" type="button"><a href="index.php?quanly=xoadiachi&id=<?php echo $row['id_diachi'] ?>">Xóa</a></button>
            </td>
        </tr>
        <?php
                $i++;
            }
        ?>
    </table>
    <div class="row mb-3">
        <div class="col-2 offset-sm-10">
        <button class="btn btn-info" type="button"><a href="index.php?quanly=themdiachi&id=<?php echo $id_dangky ?>" >Thêm địa chỉ mới</a></button>
        </div>
    </div>
    
</div>
