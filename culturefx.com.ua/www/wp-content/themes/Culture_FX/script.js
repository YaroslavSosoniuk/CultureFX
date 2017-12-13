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
    $(".age_radio").bind("change", function () {
        var checked_age = this;
        if($(checked_age).prop('checked')) {
            $('.age_points .age_radio').each(function(){
                if($(this).prop('checked') && this != checked_age){
                    $(this).prop('checked', false);
                }
            });
        }
    });
    $(".gender_radio").bind("change", function () {
        var checked_gender = this;
        if($(checked_gender).prop('checked')) {
            $('.gender_radio').each(function(){
                if($(this).prop('checked') && this != checked_gender){
                    $(this).prop('checked', false);
                }
            });
        }
    });

    $('.c-level-input input').bind("change", function(){
        var c_level_input = this;
        if($(c_level_input).prop('checked')){
            $('.c-level-input input').each(function(){
                if($(this).prop('checked') && this != c_level_input){
                    $(this).prop('checked', false);
                }
            });
        }
    });
});
