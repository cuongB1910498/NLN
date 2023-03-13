$(document).ready(function(){
    order_sta();
    var chart_status = new Morris.Donut({
            
        element: 'order_status',
        data:[
            {label:"Not Yet",value:9}
        ] 
    });
    function order_sta(){
        $.ajax({
            url: "modules/thongke/order_stutus.php",
            method: "POST",
            dataType: "JSON",
            success: function(data){
                chart_status.setData(data)
            } 
        })
    }
});