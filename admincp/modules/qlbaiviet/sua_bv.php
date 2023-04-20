<?php
    $id_baiviet = $_GET['id'];
    // $sql_lk = "SELECT * FROM tbl_baiviet WHERE id_baiviet = '".$id_baiviet."' ";
    // $query_lk = mysqli_query($mysqli, $sql_lk);
    // $row = mysqli_fetch_array($query_lk);

    $stmt_get = $pdo->prepare(
        "SELECT * FROM tbl_baiviet WHERE id_baiviet = :id_bv"
    );

    $stmt_get->execute([
        'id_bv' => $id_baiviet
    ]);

    $row = $stmt_get->fetch();
    
    if(isset($_POST['suabaiviet'])){
        // có upload ảnh mới
        if(!empty($_FILES['anh_mh']['name'])){
            // xóa ảnh cũ
            unlink('modules/qlbaiviet/uploads/'.$row['anh_mh']);

            //cập nhật lại csdl
            $tieude = $_POST['tieude'];
            $noidung = $_POST['noidung'];
            $tag = $_POST['tag'];

            //xu ly anh
            $anh_mh = $_FILES['anh_mh']['name'];
            $anh_mh_tmp = $_FILES['anh_mh']['tmp_name'];
            
            $location = 'modules/qlbaiviet/uploads/';
            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);
            $valid_extension = array("png","jpeg","jpg");

            $anh_mh = time().'_'.$anh_mh.$file_extension;
            move_uploaded_file($anh_mh_tmp, $location.$anh_mh);

            $stmt = $pdo->prepare(
                "UPDATE tbl_baiviet 
                SET tieude = :td, noidung = :nd, anh_mh = :anh, tag = :tag
                WHERE id_baiviet = :id"
            );
            $stmt->execute([
                'td' => $tieude,
                'nd' => $noidung,
                'anh' => $anh_mh,
                'tag' => $tag,
                'id' => $id_baiviet
            ]);
            
            // $sql = "UPDATE tbl_baiviet 
            // SET tieude = '".$tieude."', noidung = '".$noidung."', anh_mh = '".$anh_mh."', tag = '".$tag."'
            // WHERE id_baiviet = $id_baiviet;";
            // echo $sql;
            // $query = mysqli_query($mysqli, $sql);
            
            //cẩn thận với vị trí lưu tệp. tốt nhất là nên làm 1 file xử lý độc lập
            // move_uploaded_file($anh_mh_tmp, 'modules/qlbaiviet/uploads/'.$anh_mh);
            header("location: index.php?action=thembaiviet");
        }else{
            
            //  nếu k có up ảnh mới
            $tieude = $_POST['tieude'];
            $noidung = $_POST['noidung'];
            $tag = $_POST['tag'];
            // $sql = "UPDATE tbl_baiviet 
            // SET tieude = '".$tieude."', noidung = '".$noidung."', tag = '".$tag."'
            // WHERE id_baiviet = $id_baiviet;";
            // echo $sql;
            // $query = mysqli_query($mysqli, $sql);

            $stmt = $pdo->prepare(
                "UPDATE tbl_baiviet 
                SET tieude = :td, noidung = :nd, tag = :tag
                WHERE id_baiviet = :id"
            );
            $stmt->execute([
                'td' => $tieude,
                'nd' => $noidung,
                'tag' => $tag,
                'id' => $id_baiviet
            ]);
            
            header("location:location:index.php?action=thembaiviet");
        }
        
        
    }

    
?>


<div class="row">
    <h2 class="mb-3">SỬA BÀI VIẾT: </h2>
    <form method="post" class="col-10 offset-1" enctype='multipart/form-data' autocomplete="off">
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