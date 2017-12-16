$("document").ready(function(){
    var index_of_input, final_index_of_input = 0, index_of_checked_input = 0;
    $(".ratings").mouseenter(function(){
        $(".ratings>span").children('input').hover(function(){
            index_of_input = $(this).val();
            if(index_of_input >= index_of_checked_input){
                var spans = $(".ratings").children("span");
                $.each(spans, function(index , value){
                    $(spans[index]).removeClass("filled_star");
                });
                $.each(spans, function(index , value){
                    if(index < index_of_input) $(spans[index]).toggleClass("filled_star");
                });
            }
        });
        $(".ratings>span").children('input').on('click', function(){
            $(this).attr('checked', true);
            index_of_checked_input = $(this).val();
            var spans = $(".ratings").children("span");
            $.each(spans, function(index, value){
                if(index >= index_of_checked_input){
                        $(spans[index]).removeClass("filled_star");
                }else{
                    $(spans[index]).addClass("filled_star");
                }
            });
            $('.post_rate').val(index_of_checked_input);
        });
    });
    $(".ratings").mouseleave(function(){
        var spans = $(".ratings").children("span");
        $.each(spans, function(index, value){
            if(index >= index_of_checked_input){
                    $(spans[index]).removeClass("filled_star");
            }else{
                $(spans[index]).addClass("filled_star");
            }
        });
    });
});
