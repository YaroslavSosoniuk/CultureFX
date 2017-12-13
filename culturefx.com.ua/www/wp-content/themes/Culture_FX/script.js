$(document).ready(function(){
    
    $('input[name="first_name"]').on("input", function(){
        var name = $(this).val();
        if(name != ""){
        var result = name.match(/[A-Za-z]/gi);
        if((result == null)){
            $(this).val("");
        }else
        if(result.length < name.length){
            $(this).val("");
            }
        }
    });
});
