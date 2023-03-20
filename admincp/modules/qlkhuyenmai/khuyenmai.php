<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stmt = $pdo->prepare(
            "INSERT INTO tbl_khuyenmai VALUES(:ma, :ten, :nd, :gia, :hethan)"
        );
        $stmt ->execute([
            'ma' => $_POST['makm'],
            'ten' => $_POST['tenkm'],
            'nd' => $_POST['nd'],
            'gia' => $_POST['giakm'],
            'hethan' => $_POST['hethan']
        ]); 
    }

?>

<div class="row">
    <h2 class="mb-3">THÊM KHUYẾN MÃI</h2>
    <form method="post"  class="col-10 offset-1" id="themkm" autocomplete="off">
        <div class="form-group mb-3 row">
            <label for="makm" class="col-3" >MÃ KHUYẾN MÃI: </label>
            <div class="col-7"><input id="makm" class="form-control" type="text" name="makm"></div>
        </div>

        <div class="form-group mb-3 row">
            <label for="tenkm" class="col-3">TÊN KHUYẾN MÃI: </label>
            <div class="col-7"><input id="tenkm" class="form-control" type="text" name="tenkm"></div>
        </div>

        <div class="form-group mb-3">
            <label for="nd" class="mb-3">NỘI DUNG KM: </label>
            <textarea name="nd" id="nd" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group mb-3 row">
            <label for="giakm" class="mb-3 col-3" >GIÁ KM: </label>
            <div class="col-7"><input class="form-control" type="text" name="giakm" id="giakm"></div>
        </div>

        <div class="form-group mb-3 row">
            <label for="hethan" class="col-3" >NGÀY HẾT HẠN: </label>
            <div class="col-7"><input id="hethan" class="form-control" type="date" name="hethan"></div>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-primary" type="submit" name="thembaiviet">THÊM</button>
        </div>
    </form>
</div>

<div class="row">
    <p>Khuyễn mãi cũ</p>
    <table class="col-10 offset-1">
        <tr>
            <th>Mã Khuyến mãi</th>
            <th>Tên Khuyến mãi</th>
            <th>Giá Khuyến mãi</th>
            <th>Ngày hết hạn</th>
            <th>quản lý</th>
        </tr>

        <?php 
            $sql = $pdo->prepare("SELECT * FROM tbl_khuyenmai");
            $sql->execute();
            while ($row = $sql->fetch()){
        ?>
        
        <tr>
            <td><?php echo $row['makm'];?></td>
            <td><?php echo $row['tenkm']; ?></td>
            <td><?php echo $row['giakm']; ?></td>
            <td><?php echo $row['hethan']; ?></td>
            <td>
                <a href="index.php?action=suakm&makm=<?php echo $row['makm']; ?>" class="btn btn-warning">Sửa</a>
                <a href="index.php?action=xoakm&makm=<?php echo $row['makm']; ?>" class="btn btn-danger">Xóa</a>
            </td>
        </tr>

        <?php 
            }
        ?>
    </table>
</div>