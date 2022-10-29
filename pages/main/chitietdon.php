<div class="chitietdon">
<?php 
    $madon = $_GET['id'];
    // echo "day la trang chi tiet don <br>";
    $sql = "SELECT * FROM tbl_sanpham as a, tbl_chitietdon as b
    WHERE a.id_sanpham = b.id_sanpham 
    AND madon = $madon";
    $query_pro = mysqli_query($mysqli, $sql);
    // echo $sql;

?>
<h2>ma don hang: <?php echo $madon ?></h2>
<table border="1" class="chitietdon">
    <tr>
        <th>STT</th>
        <th>MA SP</th>
        <th>TEN SP</th>
        <th>HINH ANH</th>
        <th>SO LUONG</th>
        <th>GIA</th>
        <th>THANH TIEN</th>
    </tr>
    <?php 
    $i = 0;
    $tongtien = 0;
    $thanhtien = 0;
    while  ($row = mysqli_fetch_array($query_pro)){
        $i++;
        $thanhtien = $row['giasp']*$row['sl_mua'];
        $tongtien+=$thanhtien;
?>
<!-- code here -->
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['masp'] ?></td>
        <td><?php echo $row['tensanpham'] ?></td>
        <td><img src="admincp/modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" alt="" width="100px" height="auto"> </td>
        <td><?php echo $row['sl_mua'] ?></td>
        <td><?php echo number_format($row['giasp'],0,',','.').'vnđ'?></td>
        <td><?php echo number_format($thanhtien,0,',','.').'vnđ'?></td>
        
    </tr>
    <?php 
        } 
    ?>
    <tr>
    <td colspan="7">Tong tien : <?php echo $tongtien ?></td>
    </tr>

</table>
</div>