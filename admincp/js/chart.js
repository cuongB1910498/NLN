$(document).ready(function(){
    thongke();
    var char_order = new Morris.Line({
        
        element: 'myfirstchart',
            
        xkey: 'date',
            
        ykeys: ['order'],
            
        labels: ['Tổng đơn']
    });

    $(document).on('change', '.select-day', function(){
        var thoigian = $(this).val();
        if(thoigian == '7ngay'){
            var text = '7 ngày'
        }else if(thoigian == '30ngay'){
            var text = '30 ngày'
        }else if(thoigian == '60ngay'){
            var text =' 60 ngày'
        }else if(thoigian == '90ngay'){
            var text = '90 ngày'
        }else if(thoigian == '180ngay'){
            var text ='180 ngày'
        }else{
            var text = '365 ngày'
        }
        $.ajax({
            url: "modules/thongke/process_chart.php",
            method: "POST",
            dataType: "JSON",
            data:{thoigian: thoigian},
            success: function(data){
                char_order.setData(data),
                $("#text-day").text(text);
            }
        })
    });


    function thongke(){
        var text = "365 ngày";
        $("#text-day").text(text);
        $.ajax({
            url: "modules/thongke/process_chart.php",
            method: "POST",
            dataType: "JSON",
            success: function(data){
                char_order.setData(data),
                $("#text-day").text(text);
            } 
        })
    } 
});



