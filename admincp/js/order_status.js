$(document).ready(function(){
    order_sta();
    var chart_status = new Morris.Bar({    
        element: 'order_status',
        xkey: 'y',
        ykeys: ['a'],
        labels: ['số đơn']
    });
    function order_sta(){
        $.ajax({
            url: "modules/thongke/order_status.php",
            method: "POST",
            dataType: "JSON",
            success: function(data){
               chart_status.setData(data);
            } 
        })
    }
});