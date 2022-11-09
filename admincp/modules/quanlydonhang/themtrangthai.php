<?php
    $madon = $_GET['madon'];
    //echo $madon;
    
    //lấy trạng thái đơn

    $sql = "SELECT * FROM tbl_trangthaidon as a, tbl_chitiet_tt as b
    WHERE a.id_trangthai = b.id_trangthai 
    AND madon = '".$madon."' ";
    //echo $sql;
    $query = mysqli_query($mysqli, $sql);

    // cập nhật đơn
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //echo "ok";
        $tentrangthai = $_POST['tentrangthai'];
        $sql_tentt = "SELECT id_trangthai FROM tbl_trangthaidon WHERE tentrangthai = '".$tentrangthai."'";
        //echo $sql_tentt;
        $query_tentt = mysqli_query($mysqli, $sql_tentt);
        $row_tentt = mysqli_fetch_array($query_tentt);
        $id_trangthai = $row_tentt['id_trangthai'];
        $ghichu = $_POST['ghichu'];
        
        // cập nhật lại csdl nếu hủy đơn
        if($id_trangthai == 6){
            $sql_chondonhuy = "SELECT * from tbl_chitietdon WHERE madon = '".$madon."' ";
            $query_chondonhuy = mysqli_query($mysqli, $sql_chondonhuy);
            
            while ($row = mysqli_fetch_array($query_chondonhuy)){
                $sql_themlai = "UPDATE tbl_sanpham SET soluong = soluong + '".$row['sl_mua']."' 
                WHERE id_sanpham = '".$row['id_sanpham']."' ";
                $query_themlai = mysqli_query($mysqli, $sql_themlai);
            }
        }


        //echo $id_trangthai;
        $sql_capnhat = "INSERT INTO tbl_chitiet_tt(madon, id_trangthai, ghichu) 
        VALUES ('".$madon."', '".$id_trangthai."', '".$ghichu."')";
        //echo $sql_capnhat;        
        $query_capnhat = mysqli_query($mysqli, $sql_capnhat);
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
                while($row = mysqli_fetch_array($query)){
                    
    
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
                    $sql_tt = "SELECT * FROM tbl_trangthaidon WHERE id_trangthai 
                    not in(SELECT id_trangthai FROM tbl_chitiet_tt WHERE madon='".$madon."')";
                    $query_tt = mysqli_query($mysqli, $sql_tt);
                    while($row_tt = mysqli_fetch_array($query_tt)){
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