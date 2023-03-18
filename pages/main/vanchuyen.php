<?php
    $khuyenmai =0;
    if(isset($_POST['km'])){
        $stmt = $pdo->prepare("SELECT * FROM tbl_khuyenmai WHERE makm = :ma LIMIT 1");
        $stmt -> execute([
            'ma'=>$_POST['makm']
        ]);
        $row = $stmt->fetch();
        if($stmt->rowCount() > 0){
            $khuyenmai = $row['giakm'];
        }
    }
?>

<div class="row mb-3">
    <h2>XEM LẠI THÔNG TIN ĐƠN HÀNG</h2>
    <table style="width:100%;text-align: center;border-collapse: collapse;" border="1">
    <tr>
        <th>Id</th>
        <th>Mã sp</th>
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Số lượng</th>
        <th>Giá sản phẩm</th>
        <th>Thành tiền</th>
        
    </tr>

    <?php
        if(isset($_SESSION['cart'])){
            $i = 0;
            $tongtien = 0;
            foreach($_SESSION['cart'] as $cart_item){
                $thanhtien = $cart_item['soluong']*$cart_item['giasp'];
                $tongtien+=$thanhtien;
                $i++;
                $id = $cart_item['id'];
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $cart_item['masp']; ?></td>
        <td><?php echo $cart_item['tensanpham']; ?></td>
        <td><img src="admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>" width="150px"></td>
        <td><?php echo $cart_item['soluong'] ?></td>
        <td><?php echo number_format($cart_item['giasp'],0,',','.').'vnđ'; ?></td>
        <td><?php echo number_format($thanhtien,0,',','.').'vnđ' ?></td>
    
    </tr>
    <?php
        }
    
    ?>

    <tr>
        <td colspan="7">
            <?php echo "Tổng tiền (chưa bao gồm phí vận chuyển): ".number_format($tongtien,0,',','.').'vnđ'; ?>
        </td>
    </tr>

    <?php
        }
    ?>
    
    </table>
</div>


<?php
    //echo $_SESSION['dangnhap'];
    $id_dangky = $_SESSION['dangnhap'];
    // $sql_vc = "SELECT * FROM tbl_diachi as a, tbl_tinh as b WHERE a.id_tinh = b.id_tinh
    // AND id_dangky = '".$id_dangky."' ";
    // $query_vc = mysqli_query($mysqli, $sql_vc);
    $query_vc = $pdo->prepare(
        "SELECT * FROM tbl_diachi as a, tbl_tinh as b WHERE a.id_tinh = b.id_tinh
        AND id_dangky = :id"
    );
    $query_vc->execute([
        'id' => $id_dangky
    ]);
    $count_diachi = $query_vc->rowCount();
?>
<div class="row mb-3">
    <form action="" method="post" class="mb-3">
        <label for="">Nhập khuyến mãi(nếu có):</label>
        <input type="text" name="makm">
        <button type="submit" name="km">Kiểm tra</button>
    </form>
    <?php
        if($count_diachi > 0){
    ?>
<form method="post" action="index.php?quanly=themdon&khuyenmai=<?php echo $row['makm'] ?>" class="mb-3">
    <div class="row mb-3">
        <label for="diachi" class="col-3">CHỌN ĐỊA ĐIỂM GIAO HÀNG: </label>
        <select name="diachi" id="diachi" class="col">
            
            <?php
                while ($row = $query_vc->fetch()){
            ?>

            <option>
                <?php 
                    echo $row['tendiachi'].' , '.$row['diachi'].' , '.$row['tentinh']
                ?>
            </option>
            
            <?php
                }
            ?>
        </select>
        
    </div>
    <p>Khuyến mãi: <?php echo $khuyenmai.' VND' ?></p>     
    <p>Phí vận chuyển cố định: 50.000 VND</p>
    <p>TỔNG CỘNG: 
        <?php 
            $canthanhtoan = $tongtien + 50000 - $khuyenmai;
            echo number_format($canthanhtoan,0,',','.').' VND'
        ?>
    </p>
    </div>
    <button class="btn btn-primary mb-3"> ĐẶT HÀNG</button>
</form>
<?php
    }else {    
?>
<p>Bạn chưa có địa chỉ</p>
<a href="index.php?quanly=diachi">thêm địa chỉ tại đây</a>

<?php
    }
?>