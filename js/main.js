$(document).ready(function (){
    function loadtask() {
        $.ajax({
            url: "./ajax/showNV.php",
            type: "POST",
            success: function (data) {
                $("#showNV").html(data);
            }
        })
    }
    loadtask();
    $(document).on("click","#deleteNV", function(e){
        e.preventDefault(); // k cho trang chuyển hướng
        var manv = $(this).data("manv"); // phải dùng this
        console.log(manv);
        $.ajax({
            url: "./ajax/deleteNV.php",
            type: "GET",
            data: {manv : manv},
            success: function (data) {
                if (data = 1){
                    loadtask();
                }
            }
        });
    })
    $("#uploadImage").on("change",function(){
        var img = $("#uploadImage")[0].files[0];
        var formData = new FormData();
        formData.append("img",img);
        $.ajax({
            url: "ajaxupload.php",
            type: "POST",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false, 
            beforeSend : function(){
                $("#preview").fadeOut();
                $("#err").fadeOut();
            },
            success: function(data){
                if(data=='invalid'){
                    // invalid file format.
                    $("#err").html("Invalid File !").fadeIn();
                }else{
                    // view uploaded file.
                    $("#preview").html(data).fadeIn();
                    //$("#formImg")[0].reset(); 
                }
            },
            error: function(e) {
                $("#err").html(e).fadeIn();
            }          
        });
    }); 
});