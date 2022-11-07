<?php
    $id_diachi = $_GET['id'];
    if($_SERVER['REQUEST_METHOD']==='GET'){
        
        
        // lay du lieu tu tbl_diachi
        $sql = "SELECT * FROM tbl_diachi WHERE id_diachi = $id_diachi";
        //echo $sql;
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        
        // lay du lieu tu tbl_tinh
        $sql_tinh = "SELECT * FROM tbl_tinh";
        $query_tinh = mysqli_query($mysqli ,$sql_tinh);
        
    }
    elseif($_SERVER['REQUEST_METHOD']==='POST'){
        $tendiachi = $_POST['tendiachi'];
        $diachi= $_POST['diachi'];
        
        
        $tentinh = $_POST['tinh'];
        $sql_idtinh = "SELECT id_tinh FROM tbl_tinh WHERE tentinh = '".$tentinh."'";
        $query_id_tinh = mysqli_query($mysqli, $sql_idtinh);
        $row_idtinh = mysqli_fetch_array($query_id_tinh);
        $id_tinh = $row_idtinh['id_tinh'];
        $sql = "UPDATE tbl_diachi SET tendiachi = '".$tendiachi."', diachi = '".$diachi."', id_tinh ='".$id_tinh."' 
        WHERE id_diachi = $id_diachi";
        $query = mysqli_query($mysqli, $sql);
        header("Location: index.php?quanly=diachi");
    }


   

?>
<div class="suadiachi">
    <form method="post">
        <div class="form-group row mb-3">
            <label for="tendiachi" class="col">Tên:</label>
            <div class="col">
                <input id="tendiachi" class="form-control" type="text" name="tendiachi" value="<?php if(isset($row)) echo $row['tendiachi'] ?>">
            </div> 
        </div>
        <div class="form-group row mb-3">
            <label for="diachi" class="col">Địa chỉ:</label>
            <div class="col">
                <input id="diachi" class="form-control" type="text" name="diachi" value="<?php if(isset($row)) echo $row['diachi'] ?>">
            </div> 
        </div>

        <div class="form-group mb-3">
            <label for="tinh">Tỉnh: </label>
            <select name="tinh" id="tinh">
                <?php 
                    while($row_tinh = mysqli_fetch_array($query_tinh)){
                ?>
                    <option <?php if($row_tinh['id_tinh'] == $row['id_tinh']) echo "selected" ?> ><?php echo $row_tinh['tentinh']; ?></option>
                <?php
                    }
                ?>
            </select>
        </div>

        <div class="form-group row">
            <div class="col offset-5">
                <button class="btn btn-primary" type="submit" name="suadiachi">GỬI</button>
            </div>
        </div>
    </form>
</div>