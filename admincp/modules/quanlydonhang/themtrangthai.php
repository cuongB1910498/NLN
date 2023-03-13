<?php
    require("../carbon/autoload.php");
    use Carbon\Carbon;
    use Carbon\CarbonInterval;

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
        $tentrangthai = $_POST['tentrangthai'];
        $query_tentt = $pdo->prepare(
            "SELECT id_trangthai FROM tbl_trangthaidon WHERE tentrangthai = :tentt"
        );
        $query_tentt->execute(['tentt' => $tentrangthai]);
        
        $row_tentt = $query_tentt->fetch();
        $id_trangthai = $row_tentt['id_trangthai'];
        $ghichu = $_POST['ghichu'];
        
        // cập nhật lại csdl nếu hủy đơn
        if($id_trangthai == 6){
            //update trang thai tbl_donhang.hoanthanh = -1
            $sql = "UPDATE tbl_donhang SET hoanthanh = :ht WHERE madon = :md";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'ht' => -1,
                'md' => $madon
            ]);

            // xu ly
            $query_chondonhuy = $pdo->prepare(
                "SELECT * from tbl_chitietdon WHERE madon = :ma"
            );
            $query_chondonhuy->execute(['ma' => $madon]);
                
            while ($row = $query_chondonhuy->fetch()){
                $query_themlai = $pdo->prepare(
                    "UPDATE tbl_sanpham SET soluong = soluong + :sl_mua
                        WHERE id_sanpham = :id "
                );
                $query_themlai->execute([
                    'sl_mua' => $row['sl_mua'],
                    'id' => $row['id_sanpham']
                ]);
            }
        }elseif($id_trangthai == 5){
            $sql = "UPDATE tbl_donhang SET hoanthanh = :ht WHERE madon = :md";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'ht' => 1,
                'md' => $madon
            ]);

            $lietkedon = $pdo->prepare(
                "SELECT * FROM tbl_sanpham as a, tbl_chitietdon as b, tbl_donhang as c WHERE a.id_sanpham = b.id_sanpham AND c.madon = b.madon
                AND c.madon = :md"
            );
            $lietkedon ->execute([
                'md' =>$madon
            ]);
            
            $now = Carbon::now("Asia/Ho_Chi_Minh")->toDateString();
            $thongke=$pdo->prepare(
                "SELECT * FROM tbl_thongke WHERE ngaydat = :ht"
            );
            $thongke->execute([
                'ht'=>$now
            ]);

            $doanhso = 0;
            while($row = $lietkedon->fetch()){
                $doanhso+=$row['giasp'];
            }

            $count = $thongke->rowCount();
            if( $count == 0){
                $sql = $pdo->prepare(
                    "INSERT INTO tbl_thongke(ngaydat, donhang, doanhso) 
                    VALUES(:ngaydat, :don, :ds)"
                );
                $sql->execute([
                    'ngaydat' => $now,
                    'don' => 1,
                    'ds' => $doanhso
                ]);
            }elseif($count != 0){
                while($row_tk = $thongke->fetch()){
                    $donhang = $row_tk['donhang']+1;
                    $doanhso = $row_tk['doanhso']+$doanhso;
                    $sql = $pdo->prepare(
                        "UPDATE tbl_thongke SET donhang = :dh, doanhso = :ds WHERE ngaydat = :nd"
                    );
                    $sql->execute([
                        'dh'=>$donhang,
                        'ds'=>$doanhso,
                        'nd'=>$now 
                    ]);
                }
                
            }

        }


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