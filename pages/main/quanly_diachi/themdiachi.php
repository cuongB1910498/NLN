<?php
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id_dangky = $_GET['id'];
        $tendiachi = "địa chỉ của tôi ";
        //lấy tên tỉnh
        $tentinh = $_POST['tinh'];
        $sql = "SELECT * FROM tbl_tinh WHERE tentinh = '".$tentinh."'";
        //echo $sql;
        $query = mysqli_query($mysqli, $sql);
        $row_tinh = mysqli_fetch_array($query);
        $id_tinh = $row_tinh['id_tinh'];
        
        $diachi = $_POST['diachi'];
        //echo $id_tinh;
        //echo $id_dangky;
        $sql_them = "INSERT INTO tbl_diachi(id_dangky, tendiachi, id_tinh, diachi)
        VALUE ('".$id_dangky."', '".$tendiachi."', '".$id_tinh."', '".$diachi."')";
        $query = mysqli_query($mysqli, $sql_them);
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
                    $sql = "SELECT * FROM tbl_tinh";
                    $query = mysqli_query($mysqli, $sql);
                    while($row = mysqli_fetch_array($query)){
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