$(function() {
    $(".delete").click(function(){
        var element = $(this);
        var id = element.attr("id");
        var info = 'id=' + id;
        
        if(confirm("Are you sure you want to delete this?")){
            $.ajax({
                type: "POST",
                url: "delete.php",
                data: info,
                success: function(){
                }
            });
            $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
        }
        return false;
    });

    $("#sidebar").mCustomScrollbar({
    theme: "minimal"
    });
});