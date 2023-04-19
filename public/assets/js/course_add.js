if($("#category_id").length > 0){
    $("#category_id").change(function (){
        $(".passing_percentage").show();
        if($(this).find(":selected").attr("data-type") == "video"){
            $(".passing_percentage").hide();
        }
        $("#cour    se_type").val($(this).find(":selected").attr("data-type"))
    })
}