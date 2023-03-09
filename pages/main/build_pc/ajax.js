$(document).ready(function(){
    $('#choice_bg').on('change', function(){
        var id = $(this).val();
        $.ajax({
            url: "pages/main/build_pc/data.php",
            method: "POST",
            data: {id: id},
            success: function(data){
                $(".result_bg").html(data);
            }
        });
    });

    $(document).on('change', '#cpu', function(){
        var id = $(this).val();
        $.ajax({
            url: "pages/main/build_pc/process.php",
            method: "POST",
            data: {cpu: id},
            success: function(data){
                $(".cpu-pri").html(data);
            }
        });
    });

    $(document).on('change', '#main', function(){
        var id = $(this).val();
        $.ajax({
            url: "pages/main/build_pc/process.php",
            method: "POST",
            data: {main: id},
            success: function(data){
                $(".main-pri").html(data);
            }
        });
    });

    $(document).on('change', '#61', function(){
        var id = $(this).val();
        $.ajax({
            url: "pages/main/build_pc/process.php",
            method: "POST",
            data: {ram: id},
            success: function(data){
                $(".61-pri").html(data);
            }
        });
        
    });

    $(document).on('change', '#62', function(){
        var id = $(this).val();
        $.ajax({
            url: "pages/main/build_pc/process.php",
            method: "POST",
            data: {vga: id},
            success: function(data){
                $(".62-pri").html(data);
            }
        });
       
    });

    $(document).on('change', '#63', function(){
        var id = $(this).val();
        $.ajax({
            url: "pages/main/build_pc/process.php",
            method: "POST",
            data: {psu: id},
            success: function(data){
                $(".63-pri").html(data);
            }
        });
        
    });

    $(document).on('change', '#64', function(){
        var id = $(this).val();
        $.ajax({
            url: "pages/main/build_pc/process.php",
            method: "POST",
            data: {ssd: id},
            success: function(data){
                $(".64-pri").html(data);
            }
        });
       
    });

    $(document).on('change', '#65', function(){
        var id = $(this).val();
        $.ajax({
            url: "pages/main/build_pc/process.php",
            method: "POST",
            data: {case: id},
            success: function(data){
                $(".65-pri").html(data);
            }
        });
        var paragraphs = document.querySelectorAll('p.add');
        var sum = 0;
        for(var i = 0; i < paragraphs.length; i++) {
            var value = parseInt(paragraphs[i].textContent);
            sum += value;
        }
        var result = document.getElementById("sum");
        result.textContent = sum;
    });
});