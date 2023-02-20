<?php
    $madon = $_GET['madon'];
    // hiển thị sản phẩm có trong đơn hàng
    // $sql_sp = "SELECT * FROM tbl_chitietdon as a, tbl_sanpham as b 
    // WHERE a.id_sanpham = b.id_sanpham
    // AND madon = '".$madon."' ";
    // $query_sp = mysqli_query($mysqli, $sql_sp);
    $query_sp = $pdo->prepare(
        "SELECT * FROM tbl_chitietdon as a, tbl_sanpham as b 
            WHERE a.id_sanpham = b.id_sanpham"
    );
    $query_sp->execute();
    //echo $sql_sp;
    
    //hiển thị trạng thái đơn
    // $sql = "SELECT * FROM tbl_trangthaidon as a, tbl_chitiet_tt as b
    // WHERE a.id_trangthai = b.id_trangthai 
    // AND madon = '".$madon."' ";
    //echo $sql;
    // $query = mysqli_query($mysqli, $sql);
    $query = $pdo->prepare(
        "SELECT * FROM tbl_trangthaidon as a, tbl_chitiet_tt as b
            WHERE a.id_trangthai = b.id_trangthai 
            AND madon = :ma"
    );
    $query->execute(['ma' => $madon]);
?>


<!-- hiển thị các sản phẩm mua trong đơn hàng -->
<h1>Đơn hàng: <?php echo $madon ?></h1>
<div class="row" id="chitiet">
    <div class="col offset-1">
        <h2>CHI TIẾT ĐƠN</h2>
        <table>
        <tr>
            <th>STT</th>
            <th>TÊN SẢN PHẨM</th>
            <th>SÔ LƯỢNG MUA</th>
            <th>GIÁ</th>
            <th>THÀNH TIỀN</th>
            
        </tr>

        <?php
        
        $i = 1;
        $tongtien = 0;
        $thanhtien = 0;
        while ($row_sp = $query_sp->fetch()){
            
            $tongtien = $row_sp['giasp']*$row_sp['sl_mua'];
            $thanhtien += $tongtien;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row_sp['tensanpham'] ?></td>
            <td><?php echo $row_sp['sl_mua'] ?></td>
            <td><?php echo number_format($row_sp['giasp'], 0, ',', '.').' VND' ?></td>
            <td><?php echo number_format($tongtien, 0, ',', '.').' VND' ?></td>
            
        </tr>
        
        <?php
            $i++;
        }
        ?>

       
        
        </table>
        <?php echo "Thành tiền: ". number_format($thanhtien, 0, ',', '.')." VND" ?></td>
    </div>
</div>


<!-- hiển thị các trạng thái của đơn hàng -->
<div class="row">
    <div class="col offset-1 mb-3">
        <h2>TRẠNG THÁI ĐƠN</h2>
        <table>
            <tr>
                <th>STT</th>
                <th>TÊN TRẠNG THÁI</th>
                <th>GHI CHÚ</th>
                <th>THỜI GIAN</th>
            </tr>

            <?php 
                $i=1;
                while($row = $query->fetch()){
                    
    
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['tentrangthai'] ?></td>
                <td><?php echo $row['ghichu'] ?></td>
                <td><?php echo $row['thoigian'] ?></td>
            </tr>

            <?php
                    $i++;
                }
            ?>
        </table>
    </div>
</div>

<!-- nút lệnh điều khiển -->
<div class="row">
    <div class="col offset-4 ">
        <?php
            // $sql_check = "SELECT * FROM tbl_chitiet_tt WHERE madon = '".$madon."' ";
            //echo $sql_check;
            // $query_check = mysqli_query($mysqli, $sql_check);
            $query_check = $pdo->prepare(
                "SELECT * FROM tbl_chitiet_tt WHERE madon = :ma "
            );
            $query_check->execute(['ma' => $madon]);
            $found = false;
            while ($row_check = $query_check->fetch()){
                if(($row_check['id_trangthai'] == 5) || ($row_check['id_trangthai']== 6)){
                    $found = true;
                }
            }
            
            if($found == false){
        ?>
        <button class="btn btn-primary">
            <a href="index.php?action=themtrangthai&madon=<?php echo $madon ?>">THÊM TRẠNG THÁI</a>
        </button>
        <button class="btn btn-primary">
            <a href="index.php?action=suatrangthai&madon=<?php echo $madon ?>">SỬA GHI CHÚ</a>
        </button>

        <?php } ?>
    </div>
</div>
