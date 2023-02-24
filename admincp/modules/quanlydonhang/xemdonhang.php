<div class="row mb-4">
    <div class="col offset-10">
        <select name="trangthai" class="tuychon">
            <option value="all">Tất cả</option>
            <option value="0">Chưa hoàn thành</option>
            <option value="1">Đã hoàn thành</option>
            <option value="-1">Đã hủy</option>
            
        </select>
    </div>
</div>

<div class="re-data">
    
</div>

<table class="table" id="showAll">
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
        $query = $pdo->prepare(
            "SELECT * FROM tbl_donhang as a, tbl_dangky as b
                WHERE a.id_dangky = b.id_dangky"
        );
        $query->execute();
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
