<?php 
    $filler = "Tất cả";
    // $sql = "SELECT * FROM tbl_donhang as a, tbl_dangky as b
    // WHERE a.id_dangky = b.id_dangky";
    // $query = mysqli_query($mysqli, $sql);
    $query = $pdo->prepare(
        "SELECT * FROM tbl_donhang as a, tbl_dangky as b
            WHERE a.id_dangky = b.id_dangky"
    );
    $query->execute();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $filler = $_POST['trangthai'];
        if($filler == 'Tất cả'){
            // $sql = "SELECT * FROM tbl_donhang as a, tbl_dangky as b
            // WHERE a.id_dangky = b.id_dangky";
            // $query = mysqli_query($mysqli, $sql);
            $query = $pdo->prepare(
                "SELECT * FROM tbl_donhang as a, tbl_dangky as b
                    WHERE a.id_dangky = b.id_dangky"
            );
            $query->execute();
        }elseif($filler == 'Đã hoàn thành'){
            // $sql = "SELECT * FROM tbl_donhang as a, tbl_chitiet_tt as b, tbl_trangthaidon as c, tbl_dangky as d
            // WHERE a.madon = b.madon AND b.id_trangthai = c.id_trangthai AND d.id_dangky = a.id_dangky
            // HAVING b.id_trangthai = 5";
            // $query = mysqli_query($mysqli, $sql);
            $query = $pdo->prepare(
                "SELECT * FROM tbl_donhang as a, tbl_chitiet_tt as b, tbl_trangthaidon as c, tbl_dangky as d
                    WHERE a.madon = b.madon AND b.id_trangthai = c.id_trangthai AND d.id_dangky = a.id_dangky
                    HAVING b.id_trangthai = 5"
            );
            $query->execute();
        }elseif($filler == 'Đã hủy'){
            // $sql = "SELECT * FROM tbl_donhang as a, tbl_chitiet_tt as b, tbl_trangthaidon as c, tbl_dangky as d
            // WHERE a.madon = b.madon AND b.id_trangthai = c.id_trangthai AND d.id_dangky = a.id_dangky
            // HAVING b.id_trangthai = 6";
            // $query = mysqli_query($mysqli, $sql);
            $query = $pdo->prepare(
                "SELECT * FROM tbl_donhang as a, tbl_chitiet_tt as b, tbl_trangthaidon as c, tbl_dangky as d
                    WHERE a.madon = b.madon AND b.id_trangthai = c.id_trangthai AND d.id_dangky = a.id_dangky
                    HAVING b.id_trangthai = 6"
            );
            $query->execute();
        }else{
            
            // $sql = "SELECT * FROM tbl_donhang as a, tbl_dangky as b
            // WHERE a.id_dangky = b.id_dangky";
            // $query = mysqli_query($mysqli, $sql);
            $query = $pdo->prepare(
                "SELECT * FROM tbl_donhang as a, tbl_dangky as b
                    WHERE a.id_dangky = b.id_dangky"
            );
            $query->execute();
        }
    }
?>

<?php
    
?>
<div class="row m-4"></div>
<div class="row mb-4">
    <div class="col offset-10">
        <form method="POST">
            <div class="form-group">
                <select name="trangthai">
                    <option <?php if($filler == "Chưa hoàn thành") echo "selected"?>>Chưa hoàn thành</option>
                    <option <?php if($filler == "Đã hoàn thành") echo "selected"?>>Đã hoàn thành</option>
                    <option <?php if($filler == "Đã hủy") echo "selected"?>>Đã hủy</option>
                    <option <?php if($filler == "Tất cả") echo "selected"?>>Tất cả</option>
                </select>
                <button class="btn btn-sm btn-primary" type="submit">Lọc</button>
            </div>
        </form>
        
    </div>
</div>

<table class="table table-light">
    
    <tr>
        <th>STT</th>
        <th>MÃ ĐƠN</th>
        <th>Tên Khách</th>
        <th>SĐT</th>
        <th>Ngày tạo</th>
        <th>Trạng thái</th>
        <th>Hành Động</th>
    </tr>

    <?php 
    if($filler == "Tất cả"){
        $i = 0;
        while($row = $query->fetch()){
            $i++;
            // $sql_check = "SELECT * FROM tbl_chitiet_tt WHERE madon = '".$row['madon']."' ";
            //echo $sql_check;
            // $query_check = mysqli_query($mysqli, $sql_check);
            $query_check = $pdo->prepare(
                "SELECT * FROM tbl_chitiet_tt WHERE madon = :ma"
            );
            $query_check->execute(['ma'=>$row['madon']]);
            $found = "";
            while ($row_check = $query_check->fetch()){
                if($row_check['id_trangthai'] == 5){
                    $found = "Đã Hoàn Thành";
                }elseif(($row_check['id_trangthai'] == 6)){
                    $found = "Đã Hủy";
                }else{
                    $found = "Chưa Hoàn Thành";
                }
            }
        
    
        
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['madon'] ?></td>
        <td><?php echo $row['tenkhachhang'] ?></td>
        <td><?php echo $row['dienthoai'] ?></td>
        <td><?php echo $row['ngay_tao'] ?></td>
        <td><?php echo $found ?></td>
        <td>
        <button class="btn btn-info"><a href="index.php?action=quanlydonhang&query=xemchitiet&madon=<?php echo $row['madon'] ?>">Cập Nhật Đơn</a></button>
            
        </td>
    </tr>

    <?php
        }
    }elseif($filler == 'Đã hoàn thành'){
        $i = 0;
        while($row = $query->fetch()){
            $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['madon'] ?></td>
        <td><?php echo $row['tenkhachhang'] ?></td>
        <td><?php echo $row['dienthoai'] ?></td>
        <td><?php echo $row['ngay_tao'] ?></td>
        <td><?php echo $row['tentrangthai'] ?></td>
        <td>
        <button class="btn btn-info"><a href="index.php?action=quanlydonhang&query=xemchitiet&madon=<?php echo $row['madon'] ?>">Cập Nhật Đơn</a></button>
            
        </td>
    </tr>

    <?php }
        }elseif($filler == 'Đã hủy'){
            $i = 0;
            while($row = $query->fetch()){
                $i++;
    ?>
        <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['madon'] ?></td>
        <td><?php echo $row['tenkhachhang'] ?></td>
        <td><?php echo $row['dienthoai'] ?></td>
        <td><?php echo $row['ngay_tao'] ?></td>
        <td><?php echo $row['tentrangthai'] ?></td>
        <td>
        <button class="btn btn-info"><a href="index.php?action=quanlydonhang&query=xemchitiet&madon=<?php echo $row['madon'] ?>">Cập Nhật Đơn</a></button>    
        </td>
        </tr>
    <?php 
            }
        }else{
            $i = 0;
           while($row = $query->fetch()){
            $i++;
            // $sql_check = "SELECT * FROM tbl_chitiet_tt WHERE madon = '".$row['madon']."' ";
            // echo $sql_check;
            // $query_check = mysqli_query($mysqli, $sql_check);
            $query_check = $pdo->prepare(
                "SELECT * FROM tbl_chitiet_tt WHERE madon = :madon"
            );
            $query_check->execute(['madon' => $row['madon']]);
            $found = "";
            while ($row_check = $query_check->fetch()){
                if($row_check['id_trangthai'] == 5){
                    $found = "Đã Hoàn Thành";
                }elseif(($row_check['id_trangthai'] == 6)){
                    $found = "Đã Hủy";
                }else{
                    $found = "Chưa Hoàn Thành";
                }
            }
    ?>
    <tr>
    <td><?php echo $i ?></td>
        <td><?php echo $row['madon'] ?></td>
        <td><?php echo $row['tenkhachhang'] ?></td>
        <td><?php echo $row['dienthoai'] ?></td>
        <td><?php echo $row['ngay_tao'] ?></td>
        <td><?php echo $found ?></td>
        <td>
        <button class="btn btn-info"><a href="index.php?action=quanlydonhang&query=xemchitiet&madon=<?php echo $row['madon'] ?>">Cập Nhật Đơn</a></button>
            
    </td>
    </tr>

    <?php }
        }
    ?>
</table>