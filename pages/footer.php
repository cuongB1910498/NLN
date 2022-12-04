<div class="footer bg-success row">
    <div class="col-lg-3 col-12 offset-lg-1"> 
       <img src="images/lolo_chinhthuc.jpg" alt="error" width="150px">
        <p style="font-weight: bold; color: white;">Tổng công ti THYN</p>
        <p style="font-weight: bold; color: white;">THYN FARM</p>
        <p style="color: white;">Địa chỉ: CẦN THƠ VIỆT NAM</p>
        <p  style="color: white;">Điện thoại: 0123456789</p>
    </div>
    <div class="col-lg-2 col-6">
        <?php
            $sql = "SELECT * FROM tbl_baiviet order by ngaytao DESC LIMIT 4";
            $query = mysqli_query($mysqli, $sql);

        ?>
        <div>
            <div><h3 style="font-weight: bold;">BÀI VIẾT</h3></div>
            <div class="row">
                <?php
                    while ($row = mysqli_fetch_array($query)){

                ?>
                    
                <div class="row mb-3">
                <a class="f_baiviet" href="index.php?quanly=chitiet_bv&id=<?php echo $row['id_baiviet'] ?>"><?php echo $row['tieude'] ?></a>
                </div>
                
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="lk col-lg-2 col-6">
        <div><h3 style="font-weight: bold;">LIÊN KẾT</h3></div>
        <div class="row"><a href="pages/main/dangnhap.php">Đăng Nhập</a></div>
        <div class="row"><a href="index.php?quanly=tintuc">Bài viết</a></div>
        <div class="row"><a href="index.php?quanly=khuyenmai">Khuyến mãi</a></div>
        
    </div>

    <div class="col-lg-3 col-12"> 
        <div><h3 style="font-weight: bold;">MẠNG XÃ HỘI</h3></div>
        
        <div class="mxh row justify-content-center"><a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook"></i> FACEBOOK</a></div>
        <div class="mxh row justify-content-center"><a href="https://www.youtube.com" target="_blank"><i class="fa-brands fa-youtube"></i> YOUTUBE</a></div>
        

    </div>
</div>

<!-- <div class="fotter bg-secondary row">
    <div class="left-c col-lg-4 col-md-4 col-sm-4 col-12">Coppyright 2022</div>
        <div class="mid-c col-lg-4 col-md-4 col-sm-4 col-12"> Da thong bao bo cong thuong</div>
        <div class="right-c col-lg-4 col-md-4 col-sm-4 col-12">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>  
            <a href="#"><i class="fa-brands fa-youtube"></i></a>
        </div>
</div> -->