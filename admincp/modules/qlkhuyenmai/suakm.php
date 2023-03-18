<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stmt = $pdo->prepare(
            "UPDATE tbl_khuyenmai SET makm = :ma, tenkm = :ten, nd = :nd, giakm = :gia, hethan = :hethan
            WHERE makm = :makm"
        );
        $stmt ->execute([
            'ma' => $_POST['makm'],
            'ten' => $_POST['tenkm'],
            'nd' => $_POST['nd'],
            'gia' => $_POST['giakm'],
            'hethan' => $_POST['hethan'],
            'makm' => $_GET['makm']
        ]);
        header("Location: index.php?action=themkhuyenmai");
    }

    
    $sql = $pdo->prepare("SELECT * FROM tbl_khuyenmai WHERE makm = '".$_GET['makm']."'");
    $sql ->execute();
    $row = $sql->fetch();
    

?>

<div class="row">
    <h2 class="mb-3">SỬA KHUYẾN MÃI</h2>
    <form method="post"  class="col-10 offset-1" id="themkm">
        <div class="form-group mb-3 row">
            <label for="makm" class="col-3" >MÃ KHUYẾN MÃI: </label>
            <div class="col-7"><input id="makm" class="form-control" type="text" name="makm" value="<?php echo $row['makm'] ?>"></div>
        </div>

        <div class="form-group mb-3 row">
            <label for="tenkm" class="col-3">TÊN KHUYẾN MÃI: </label>
            <div class="col-7"><input id="tenkm" class="form-control" type="text" name="tenkm" value="<?php echo $row['tenkm'] ?>"></div>
        </div>

        <div class="form-group mb-3">
            <label for="nd" class="mb-3">NỘI DUNG KM: </label>
            <textarea name="nd" id="nd" cols="30" rows="10"><?php echo $row['nd'] ?></textarea>
        </div>

        <div class="form-group mb-3 row">
            <label for="giakm" class="mb-3 col-3" >GIÁ KM: </label>
            <div class="col-7"><input class="form-control" type="text" name="giakm" id="giakm" value="<?php echo $row['giakm'] ?>"></div>
        </div>

        <div class="form-group mb-3 row">
            <label for="hethan" class="col-3" >NGÀY HẾT HẠN: </label>
            <div class="col-7"><input id="hethan" class="form-control" type="date" name="hethan" value="<?php echo $row['hethan'] ?>"></div>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-primary" type="submit" name="thembaiviet">SỬA</button>
        </div>
    </form>
</div>