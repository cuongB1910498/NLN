<div class="chitietdon">
<?php
    // session_start();
    // include("../../admincp/config/config.php");
    $id_khach = $_SESSION['dangnhap'];
    // $sql = "SELECT * From tbl_donhang as a, tbl_chitietdon as b, tbl_dangky as c
    // WHERE a.madon = b.madon AND a.id_dangky = c.id_dangky
    // AND a.id_dangky = $id_khach
    // GROUP BY a.id_dangky";

    // $sql_don = "SELECT * From tbl_donhang
    // WHERE id_dangky = $id_khach order by madon DESC";
    // $query_pro = mysqli_query($mysqli, $sql_don);
    $query_pro = $pdo->prepare(
        "SELECT * From tbl_donhang
        WHERE id_dangky = $id_khach order by madon DESC"
    );
    $query_pro->execute();
    
?>

    <table border="1" class="lichsudon">
        <tr>
            <th>STT</th>
            <th>ID ĐƠN HÀNG</th>
            <th>THỜI GIAN ĐẶT HÀNG</th>
            <th>CHI TIẾT</th>
        </tr>
        <?php
        $i=1; 
        while($row = $query_pro->fetch()){ 
        ?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row['madon'] ?></td>
            <td><?php echo $row['ngay_tao'] ?></td>
            <td><a href="index.php?quanly=chitietdon&id=<?php echo $row['madon'] ?>">xem</a></td>
        </tr>
        <?php 
            $i++;
        }
        ?>
    </table>
</div>
