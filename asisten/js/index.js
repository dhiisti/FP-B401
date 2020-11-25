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

function triggerClick(){
    document.querySelector('#asistenPic').click();
}

function displayImage(e){
    if(e.files[0]){
        var reader = new FileReader();

        reader.onload = function(e){
            document.querySelector("#profileDisplay").setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}