<!-- headder -->
<div class="header row mb-3">
    <div class="logo align-items-center col-2">
        <a href="index.php"><img src="images/Untitled.png" alt="LOGO" id="logo"></a>
    </div>
    <div class="c-header col-10 row d-flex justify-content-end align-items-center">
        <form action="index.php?quanly=timkiem" method="POST" id="search_form" class="col">
            <div class="form-group col d-flex justify-content-end">  
                <div class="row">
                    <input type="search" placeholder="Tìm kiếm ... " name="tukhoa">
                    <label class="error"></label>
                </div>
                <button class="btn btn-sm btn-warning " type="submit" name="tiemkiem"> Tìm Kiếm</button>
            </div>
            
            
        </form>
        <div class="col-1">
            <button class="btn btn-sm btn-warning" >
                <a href="index.php?quanly=giohang">
                    <i class="fa-solid fa-cart-shopping "></i>
                </a>
            </button>
        </div>
        
    </div>
</div>

<!-- Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

   <script>
        $(document).ready(function (){
            $("#search_form").validate({
                rules:{
                    tukhoa: {required:true, }
                    
                },
                messages:{
                    tukhoa: {required:"CHƯA NHẬP SAO MÀ TIỀM KIẾM BẠN ƠI"}
                    
                },
                
            });
        });
   </script>