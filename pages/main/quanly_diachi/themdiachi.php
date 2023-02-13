<?php
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id_dangky = $_GET['id'];
        $tendiachi = "địa chỉ của tôi ";
        //lấy tên tỉnh
        $tentinh = $_POST['tinh'];
        $sql = "SELECT * FROM tbl_tinh WHERE tentinh =:ten";
        //echo $sql;
        $query = $pdo->prepare($sql);
        $query->execute(['ten'=> $tentinh]);
        $row_tinh = $query->fetch();
        $id_tinh = $row_tinh['id_tinh'];
        
        $diachi = $_POST['diachi'];
        //echo $id_tinh;
        //echo $id_dangky;
        $sql_them = "INSERT INTO tbl_diachi(id_dangky, tendiachi, id_tinh, diachi)
        VALUE (:id, :ten, :id_tinh, :dc)";
        $add = $pdo->prepare($sql_them);
        $add->execute([
            'id' => $id_dangky,
            'ten' => $tendiachi,
            'id_tinh' => $id_tinh,
            'dc' => $diachi
        ]);
        echo '<script>alert("ĐÃ THÊM ĐỊA CHỈ ");</script>';
        $page = "index.php?quanly=diachi";
        header("Location:$page");
    }
?>
<div class="themdiachi">
    <h1>THÊM ĐỊA CHỈ MỚI</h1>
    <form method="POST" id="themdiachi">
        <div class="form-group mb-3 row">
            <label for="diachi" class="mb-3">Nhập địa chỉ: </label>
            <input id="diachi" class="form-control mb-4" type="text" name="diachi" placeholder="Số nhà, tên đường, Ấp/khu vực, xã/phường/thị trấn, Huyện/thị xã/thành phố">
        </div>
        <div class="form-group mb-3">
            <label for="tinh">Tỉnh: </label>
            <select name="tinh" id="tinh"> 
                <?php 
                    $sql_tinh = "SELECT * FROM tbl_tinh";
                    $query_t =$pdo->prepare($sql_tinh);
                    $query_t->execute();
                    while($row = $query_t->fetch()){
                ?>
                <option><?php echo $row['tentinh'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <div class="row offset-6">
                <div class="col"><button class="btn btn-primary" type="submit" name="themdiachi">GỬI</button></div>
            </div>
        </div>
        
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
     $(document).ready(function(){
        $("#themdiachi").validate({
            rules:{
                diachi: {required: true}
            },
            messages:{
                diachi: {required: "Địa chỉ không được bỏ trống! "}
            }
        });
     });
</script>