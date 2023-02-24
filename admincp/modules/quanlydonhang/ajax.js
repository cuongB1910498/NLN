$(document).ready(function(){
    $(".tuychon").change(function(){
        var id = $(this).val();
        $.ajax({
            url: "modules/quanlydonhang/data.php",
            method: "POST",
            data: {id: id},
            success: function(data){
                $(".re-data").html(data);
            }
        });
        var showAll =document.querySelector("#showAll")
        showAll.classList.add("hide");
    });
});