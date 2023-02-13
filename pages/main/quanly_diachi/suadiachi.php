<?php
    $id_diachi = $_GET['id'];
    if($_SERVER['REQUEST_METHOD']==='GET'){
        
        
        // lay du lieu tu tbl_diachi
        $sql = "SELECT * FROM tbl_diachi WHERE id_diachi = :id";
        //echo $sql;
        $query = $pdo->prepare($sql);
        $query->execute(['id'=>$id_diachi]);
        $row = $query->fetch();
        
        // lay du lieu tu tbl_tinh
        $sql_tinh = "SELECT * FROM tbl_tinh";
        $query_tinh = $pdo->prepare($sql_tinh);
        $query_tinh->execute();
        
    }
    elseif($_SERVER['REQUEST_METHOD']==='POST'){
        $tendiachi = $_POST['tendiachi'];
        $diachi= $_POST['diachi'];
        
        
        $tentinh = $_POST['tinh'];
        $sql_idtinh = "SELECT id_tinh FROM tbl_tinh WHERE tentinh = :ten_tinh";
        $query_id_tinh = $pdo->prepare($sql_idtinh);
        $query_id_tinh->execute(['ten_tinh'=>$tentinh]);
        $row_idtinh =$query_id_tinh->fetch();
        $id_tinh = $row_idtinh['id_tinh'];
        $sql = "UPDATE tbl_diachi SET tendiachi = :ten, diachi = :dc, id_tinh =:id 
        WHERE id_diachi =:id_dc";
        $query = $pdo->prepare($sql);
        $query->execute([
            'ten'=>$tendiachi,
            'dc' =>$diachi,
            'id' =>$id_tinh,
            'id_dc'=> $id_diachi
        ]);
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
                    while($row_tinh = $query_tinh->fetch()){
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