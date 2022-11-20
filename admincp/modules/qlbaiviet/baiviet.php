<?php
    //them bai viet
    if(isset($_POST['thembaiviet'])){
        $tieude = $_POST['tieude'];
        $noidung = $_POST['noidung'];
        $anh_mh = $_FILES['anh_mh']['name'];
        $anh_mh_tmp = $_FILES['anh_mh']['tmp_name'];
        $anh_mh = time().'_'.$anh_mh;
        $tag = $_POST['tag'];
        $sql = "INSERT INTO tbl_baiviet(tieude,noidung,anh_mh,tag) 
        VALUES ('".$tieude."', '".$noidung."', '".$anh_mh."', '".$tag."');";
        
        $query = mysqli_query($mysqli, $sql);
        
        // cẩn thận với vị trí lưu tệp. tốt nhất là nên làm 1 file xử lý độc lập
        move_uploaded_file($anh_mh_tmp, 'modules/qlbaiviet/uploads/'.$anh_mh);
        header("location: index.php?action=quanlybaiviet&query=thembaiviet");
    } 
?>

<!-- thêm bài viết -->
<div class="row">
    <h2 class="mb-3">THÊM BÀI VIẾT</h2>
    <form method="post"  class="col-10 offset-1" enctype='multipart/form-data'>
        <div class="form-group mb-3 row">
            <label for="tieude" class="col-3" >TIÊU ĐỀ BÀI VIẾT: </label>
            <div class="col-7"><input id="tieude" class="form-control" type="text" name="tieude"></div>
        </div>

        <div class="form-group mb-3">
            <label for="noidung" class="mb-3">NỘI DUNG BÀI VIẾT: </label>
            <input id="noidung" class="form-control mb-3" type="text" name="noidung">
        </div>

        <div class="form-group mb-3">
            <label for="file">ẢNH MINH HỌA: </label>
            <input id="file" type="file" name="anh_mh">
        </div>

        <div class="form-group mb-3 row">
            <label for="tag" class="col-3" >TAG: </label>
            <div class="col-7"><input id="tag" class="form-control" type="text" name="tag"></div>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-primary" type="submit" name="thembaiviet">THÊM BÀI VIẾT</button>
        </div>
    </form>
</div>



<?php
    $sql_lk = "SELECT * FROM tbl_baiviet";
    $query_lk = mysqli_query($mysqli, $sql_lk);
?>
<!-- bài viết đã thêm -->
<div class="row">
    <h2>DANH SÁCH BÀI VIẾT CŨ</h2>
    <table class="col-10 offset-1">
            <tr>
                <th>TIÊU ĐỀ</th>
                <th>HÌNH ẢNH MINH HỌA</th>
                <th>NGÀY TẠO</th>
                <th>QUẢN LÝ</th>
            </tr>

            <?php
                while($row = mysqli_fetch_array($query_lk)){

                
            ?>
            <tr>
                <td><?php echo $row['tieude'] ?></td>
                <td><img src="modules/qlbaiviet/uploads/<?php echo $row['anh_mh']?>" alt="" width="150px">    
                </td>
                <td><?php echo date("d/m/Y", strtotime($row['ngaytao'])) ?></td>
                <td>
                    <a href="index.php?action=quanlybaiviet&query=sua&id=<?php  echo $row['id_baiviet'] ?>" class="btn btn-warning" type="button">SỬA</a>
                    <a href="index.php?action=quanlybaiviet&query=xoa&id=<?php  echo $row['id_baiviet'] ?>" class="btn btn-danger" type="button">XÓA</a>
                </td>
            </tr>

            <?php
                }
            ?>
        
    </table>
</div>