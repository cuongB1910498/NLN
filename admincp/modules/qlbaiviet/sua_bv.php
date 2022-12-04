<?php
    $id_baiviet = $_GET['id'];
    $sql_lk = "SELECT * FROM tbl_baiviet WHERE id_baiviet = '".$id_baiviet."' ";
    $query_lk = mysqli_query($mysqli, $sql_lk);
    $row = mysqli_fetch_array($query_lk);
    
    
    if(isset($_POST['suabaiviet'])){
        // có upload ảnh mới
        if(!empty($_FILES['anh_mh']['name'])){
            // xóa ảnh cũ
            unlink('modules/qlbaiviet/uploads/'.$row['anh_mh']);

            //cập nhật lại csdl
            $tieude = $_POST['tieude'];
            $noidung = $_POST['noidung'];
            $anh_mh = $_FILES['anh_mh']['name'];
            $anh_mh_tmp = $_FILES['anh_mh']['tmp_name'];
            $anh_mh = time().'_'.$anh_mh;
            $tag = $_POST['tag'];
            $sql = "UPDATE tbl_baiviet 
            SET tieude = '".$tieude."', noidung = '".$noidung."', anh_mh = '".$anh_mh."', tag = '".$tag."'
            WHERE id_baiviet = $id_baiviet;";
            echo $sql;
            $query = mysqli_query($mysqli, $sql);
            
            //cẩn thận với vị trí lưu tệp. tốt nhất là nên làm 1 file xử lý độc lập
            move_uploaded_file($anh_mh_tmp, 'modules/qlbaiviet/uploads/'.$anh_mh);
            header("location: index.php?action=quanlybaiviet&query=thembaiviet");
        }else{
            
            //  nếu k có up ảnh mới
            $tieude = $_POST['tieude'];
            $noidung = $_POST['noidung'];
            $tag = $_POST['tag'];
            $sql = "UPDATE tbl_baiviet 
            SET tieude = '".$tieude."', noidung = '".$noidung."', tag = '".$tag."'
            WHERE id_baiviet = $id_baiviet;";
            echo $sql;
            $query = mysqli_query($mysqli, $sql);
            
            header("location: index.php?action=quanlybaiviet&query=thembaiviet");
        }
        
        
    }

    
?>


<div class="row">
    <h2 class="mb-3">SỬA BÀI VIẾT: </h2>
    <form method="post" class="col-10 offset-1" enctype='multipart/form-data'>
        <div class="form-group mb-3 row">
            <label for="tieude" class="col-3" >TIÊU ĐỀ BÀI VIẾT: </label>
            <div class="col-7"><input id="tieude" class="form-control" type="text" name="tieude" value="<?php echo $row['tieude'] ?>"></div>
        </div>

        <div class="form-group mb-3">
            <label for="noidung" class="mb-3">NỘI DUNG BÀI VIẾT: </label>
            <textarea name="noidung" id="" cols="30" rows="10"><?php echo $row['noidung'] ?></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="file">ẢNH MINH HỌA MỚI: </label>
            <input id="file" type="file" name="anh_mh">
        </div>

        <div class="form-group mb-3 row">
            <label for="tag" class="col-3" >TAG: </label>
            <div class="col-7"><input id="tag" class="form-control" type="text" name="tag" value="<?php echo $row['tag'] ?>"></div>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-primary" type="submit" name="suabaiviet">CHỈNH SỬA</button>
        </div>
    </form>
</div>