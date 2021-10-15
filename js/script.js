
$(document).ready(function (e) {
    $("#form").on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
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
                    $("#form")[0].reset(); 
                }
            },
            error: function(e) {
                $("#err").html(e).fadeIn();
            }          
        });
    }));
    $("#uploadImage").on("change", function() {
        $("#form").submit();
    });
});
