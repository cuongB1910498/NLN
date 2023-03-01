$(document).ready(function(){
    $(".choice_bg").change(function(){
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
});