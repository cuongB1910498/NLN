<?php
    $madon = $_GET['madon'];
    //echo $madon;
    
    //lấy trạng thái đơn

    // $sql = "SELECT * FROM tbl_trangthaidon as a, tbl_chitiet_tt as b
    // WHERE a.id_trangthai = b.id_trangthai 
    // AND madon = '".$madon."' ";
    // //echo $sql;
    // $query = mysqli_query($mysqli, $sql);
    $query = $pdo->prepare(
        "SELECT * FROM tbl_trangthaidon as a, tbl_chitiet_tt as b
        WHERE a.id_trangthai = b.id_trangthai 
        AND madon = :ma"
    );
    $query->execute(['ma' => $madon]);

    // cập nhật đơn
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //echo "ok";
        $tentrangthai = $_POST['tentrangthai'];
        // $sql_tentt = "SELECT id_trangthai FROM tbl_trangthaidon WHERE tentrangthai = '".$tentrangthai."'";
        //echo $sql_tentt;
        // $query_tentt = mysqli_query($mysqli, $sql_tentt);
        $query_tentt = $pdo->prepare(
            "SELECT id_trangthai FROM tbl_trangthaidon WHERE tentrangthai = :tentt"
        );
        $query_tentt->execute(['tentt' => $tentrangthai]);
        
        $row_tentt = $query_tentt->fetch();
        $id_trangthai = $row_tentt['id_trangthai'];
        $ghichu = $_POST['ghichu'];
        
        // cập nhật lại csdl nếu hủy đơn
        if($id_trangthai == 6){
            // $sql_chondonhuy = "SELECT * from tbl_chitietdon WHERE madon = '".$madon."' ";
            // $query_chondonhuy = mysqli_query($mysqli, $sql_chondonhuy);
            $query_chondonhuy = $pdo->prepare(
                "SELECT * from tbl_chitietdon WHERE madon = :ma"
            );
            $query_chondonhuy->execute(['ma' => $madon]);
                
            while ($row = $query_chondonhuy->fetch()){
                // $sql_themlai = "UPDATE tbl_sanpham SET soluong = soluong + '".$row['sl_mua']."' 
                // WHERE id_sanpham = '".$row['id_sanpham']."' ";
                // $query_themlai = mysqli_query($mysqli, $sql_themlai);
                $query_themlai = $pdo->prepare(
                    "UPDATE tbl_sanpham SET soluong = soluong + :sl_mua
                        WHERE id_sanpham = :id "
                );
                $query_themlai->execute([
                    'sl_mua' => $row['sl_mua'],
                    'id' => $row['id_sanpham']
                ]);
            }
        }


        //echo $id_trangthai;
        // $sql_capnhat = "INSERT INTO tbl_chitiet_tt(madon, id_trangthai, ghichu) 
        // VALUES ('".$madon."', '".$id_trangthai."', '".$ghichu."')";
        //echo $sql_capnhat;        
        // $query_capnhat = mysqli_query($mysqli, $sql_capnhat);
        $query_capnhat = $pdo->prepare(
            "INSERT INTO tbl_chitiet_tt(madon, id_trangthai, ghichu) 
                VALUES (:ma, :id_tt, :gc)"
        );
        $query_capnhat->execute([
            'ma' => $madon,
            'id_tt' => $id_trangthai,
            'gc' => $ghichu
        ]);
        header("Location:index.php?action=quanlydonhang&query=xemchitiet&madon=$madon");
    }
?>
<div class="row">
    <div class="col offset-1 mb-3">
        <h2>TRẠNG THÁI CŨ</h2>
        <table>
            <tr>
                <th>STT</th>
                <th>TÊN TRẠNG THÁI</th>
                <th>GHI CHÚ</th>
                <th>THỜI GIAN</th>
            </tr>

            <?php 
                $i=1;
                while($row = $query -> fetch()){
                    
    
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

<div class="row">
    <div class="col-6 offset-3">
        <h2>CẬP NHẬT ĐƠN</h2>
        <form method="POST" id="themtrangthai">
            <div class="form-group mb-3">
                <label for="tentrangthai">Trạng Thái đơn</label>
                <select name="tentrangthai" id="tentrangthai">
                    <?php
                    // lấy dữ liệu từ bảng trạng thái mà không nằm trong bảng chi tiết trạng thái
                    // $sql_tt = "SELECT * FROM tbl_trangthaidon WHERE id_trangthai 
                    // not in(SELECT id_trangthai FROM tbl_chitiet_tt WHERE madon='".$madon."')";
                    // $query_tt = mysqli_query($mysqli, $sql_tt);
                    $query_tt = $pdo->prepare(
                        "SELECT * FROM tbl_trangthaidon WHERE id_trangthai 
                        not in(SELECT id_trangthai FROM tbl_chitiet_tt WHERE madon = :ma)"
                    );
                    $query_tt->execute(['ma' => $madon]);
                    while($row_tt = $query_tt->fetch()){
                    ?>

                    <option><?php echo $row_tt['tentrangthai'] ?></option>

                    <?php } ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="ghichu">Ghi chú:</label>
                <input id="ghichu" class="form-control" type="text" name="ghichu">
            </div>

            <div class="form-group mb-3 row">
                
                <div class="col offset-4">
                    <button class="btn btn-primary" type="submit" name="capnhat">CẬP NHẬT</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function(){
        $("#themtrangthai").validate({
            rules:{
                ghichu: {required: true}
            },
            messages: {
                ghichu :{required: "Không được bỏ trống ghi chú!"}
            }
        });
    });
</script>