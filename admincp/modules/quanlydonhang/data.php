<?php
    include("../../config/conect.php");
    
    if(isset($_POST['id'])){
        $filler = $_POST['id'];
        if($filler == 'all'){
            $query = $pdo->prepare(
                "SELECT * FROM tbl_donhang as a, tbl_dangky as b
                    WHERE a.id_dangky = b.id_dangky"
            );
            $query->execute();
        }elseif($filler == '1'){
            $query = $pdo->prepare(
                "SELECT * FROM tbl_donhang as a, tbl_dangky as b
                    WHERE b.id_dangky = a.id_dangky
                    AND hoanthanh = 1"
            );
            $query->execute();
        }elseif($filler == '-1'){
            
            $query = $pdo->prepare(
                "SELECT * FROM tbl_donhang as a, tbl_dangky as b
                    WHERE b.id_dangky = a.id_dangky
                    AND hoanthanh = -1"
            );
            $query->execute();
        }elseif($filler == '0'){
            $query = $pdo->prepare(
                "SELECT * FROM tbl_donhang as a, tbl_dangky as b
                    WHERE a.id_dangky = b.id_dangky
                    AND hoanthanh = 0"
            );
            $query->execute();
        }
    }
?>


<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Mã đơn</th>
      <th scope="col">Tên khách hàng</th>
      <th scope="col">SĐT</th>
      <th scope="col">Ngày tạo</th>
      <th scope="col">Quản Lý</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $i = 0;
        while($row = $query->fetch()){
            $i++
    ?>
    <tr>
        <th scope="row"><?php echo $i ?></th>
        <td><?php echo $row['madon'] ?></td>
        <td><?php echo $row['tenkhachhang'] ?></td>
        <td><?php echo $row['dienthoai'] ?></td>
        <td><?php echo $row['ngay_tao'] ?></td>
        <td>
            <button class="btn btn-info">
                <a href="index.php?action=xemchitiet&madon=<?php echo $row['madon'] ?>" >Cập Nhật Đơn</a>
            </button>
        </td>
    </tr>
    <?php
        }
    ?>
  </tbody>
</table>