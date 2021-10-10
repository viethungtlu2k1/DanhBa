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
    $(document).on("click","#deleteNV", function(){
        $.ajax({
            url: "./ajax/deleteNV.php",
            type: "POST",
            success: function () {
                loadtask();
            }
        });
    })
});