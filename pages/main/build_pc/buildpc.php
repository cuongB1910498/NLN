<form action="index.php?quanly=dathangpc" method="post" id="build">
<div class="row ">

    <div class="mb-3 row offset-lg-2">
        <label class="col-lg-2 col-md-2 col-sm-3 col-10" for="choice-bg">Nền tảng:</label>
        <div class="col-lg-8 col-md-8 col-sm-7 col-10">
            <select name="choice_bg" id="choice_bg" class="choice_bg">
                <option value=""> ---chọn nền tảng ---</option>
                <option value="1">Intel</option>
                <option value="2">AMD</option>
            </select>
        </div>
    </div>

    <div class="result_bg mb-3">

    </div>




    <div>
    <?php
        $modules = $pdo->prepare("SELECT * FROM tbl_danhmuc WHERE buildpc = 1");
        $modules -> execute();
        foreach($modules as $module){
            if($module['tendanhmuc'] == 'cpu' || $module['tendanhmuc'] == 'main') continue;
                
    ?>
        <div class="mb-3 row offset-lg-2">
            <label for="<?php echo $module['tendanhmuc'] ?>" class="col-lg-2 col-md-2 col-sm-3 col-10"><?php echo strtoupper($module['tendanhmuc']) ?>:</label>
            <div class="col-lg-5 col-md-8 col-sm-7 col-10">
                <?php
                    $cpu = $pdo->prepare(
                        "SELECT * FROM tbl_sanpham as a, tbl_danhmuc as b 
                        WHERE a.id_danhmuc = b.id_danhmuc AND tendanhmuc = :ten"
                    );
                    $cpu->execute([
                        'ten' => $module['tendanhmuc']
                    ]);
                ?>
                <select class="form-select" name="<?php echo $module['id_danhmuc'] ?>" id="<?php echo $module['id_danhmuc'] ?>">
                    <option value="" disabled selected>Chọn <?php echo $module['tendanhmuc']?> ...</option>
                    <?php
                        while($row = $cpu->fetch()){
                    ?>
                    <option value="<?php echo $row['id_sanpham'] ?>"><?php echo $row['tensanpham']." - ".number_format($row['giasp'],0,',','.').'VND' ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="<?php echo $module['id_danhmuc'].'-pri col-1'?>"></div>
        </div>

    <?php
        }
    ?>
    </div>

    <?php
        if(isset($_SESSION['dangnhap'])){
            $getAddreess = $pdo->prepare("SELECT * FROM tbl_diachi as a, tbl_tinh as b
            WHERE a.id_tinh = b.id_tinh
            AND id_dangky = :id");
            $getAddreess->execute(['id'=>$_SESSION['dangnhap']]);
    ?>
    
    <div>
    <div class="mb-3 row offset-lg-2">
        <label for="diachi" class="col-lg-2 col-md-2 col-sm-3 col-10">Địa chỉ</label>
        <div class="col-lg-5 col-md-8 col-sm-7 col-10">
            <select name="diachi" id="diachi" class="row form-select mb-3">
                <option value="">Chọn địa chỉ giao hàng</option>
                <?php
                    while($row = $getAddreess->fetch()){
                ?>
                <option value="<?php echo $row['id_diachi'] ?>"><?php echo $row['diachi'].", ".$row['tentinh'] ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        
    </div>
    </div>

    <div>
        <div class="row offset-lg-2">
            <div class="col"><button id="tinhTong" type="button" class="btn btn-success mb-3">Ước tính chi phí: </button></div>
            <div class="col"><p id="ketQua"></p></div>
        </div>
    </div>
    

    <div class="row offset-lg-3 mb-3">
        <button class="btn btn-primary col-lg-1 col-md-1 col-sm-1 col-4" type="submit">Đặt Hàng</button>
    </div>
    
    <?php
        }else{
    ?>
    
    <div class="row offset-lg-3 mb-3">
        <button class="btn btn-primary col-lg-3 col-md-3 col-sm-2 col-4"
        disabled>Đăng nhập để mua hàng</button>
    </div>
    
    <?php
        }
    ?>
</div>
</form>

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    $(document).ready(function(){
        $("#build").validate({
            rules: {
                choice_bg: {required: true},
                cpu: {required: true},
                main: {required: true},
                61: {required: true},
                62: {required: true},
                63: {required: true},
                64: {required: true},
                65: {required: true}
            },
            messages: {
                choice_bg: {required: "Vui lòng chọn nền tảng"},
                cpu: {required: "Vui lòng chọn CPU"},
                main: {required: "Vui lòng chọn Main"},
                61: {required: "Vui lòng chọn RAM"},
                62: {required: "Vui lòng chọn VGA"},
                63: {required: "Vui lòng chọn Nguồn"},
                64: {required: "Vui lòng chọn SSD"},
                65: {required: "Vui lòng chọn Vỏ"}
            }
        })
    })
</script>