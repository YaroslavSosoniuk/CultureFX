$(document).ready(function(){
    var count_of_full_inputs = 0;
    function disable(){
        $('#main_part input:checkbox').prop('disabled', true);
        $('body').css('cursor', 'wait');
        $('body').css('-webkit-filter', 'blur(2px)');
    }
    function enable(){
        $('#main_part input[type="checkbox"]').prop('disabled', false);
        $('body').css('cursor', 'default');
        $('body').css('-webkit-filter', 'none');
    }
    // $('#admin_groups label').prop('disabled', true);
    $('#admin_groups').toggleClass('active_admin_groups');
    var id_of_page;
    $(document).on('click', '.edit_admin', function(){
        id_of_page = $(this).siblings('input').attr('value');
        $.ajax({
            url: "/wp-content/themes/Culture_FX/admin-panel/edit_create_form.php",
            data: {id : id_of_page},
            method: "POST",
            success:function(html){
                $("#main_part").html(html);
            }
        });
        return false;
    });
    $("#admin_groups").click(function(){
        $.ajax({
            url:"/wp-content/themes/Culture_FX/admin-panel/table_groups.php",
            method: "POST",
            success:function(html){
                $("#main_part").html(html);
            }
        });
    });
    $(document).on('click','#create_new_group', function(){
        if($(this).hasClass('new_group')){
            $("#feedback").text("‘ Oops! You’re only allowed to create a max of 5 groups by default ‘ If you would like to create more groups you can delete an existing group to make room, or you can contact us at info@culture-fx.com to give you access to creating more groups.");
        }else{
            $.ajax({
                beforeSend: disable(),
                url: "/wp-content/themes/Culture_FX/admin-panel/edit_create_form.php",
                method: "POST",
                success:function(html){
                    $("#main_part").html(html);
                    enable();
                }
            });
        }
    });
    $('#main_part').on('click','.suspend', function(){
        var checked_suspend, id_suspend;
        id_suspend = $(this).prev('.id_page_input').attr('value');
        if($(this).val() == 1){
            checked_suspend = 0;
            $(this).val(0);
        }else{
            checked_suspend = 1;
            $(this).val(1);
        }
        $.ajax({
            beforeSend: disable(),
            url: "/wp-content/themes/Culture_FX/admin-panel/suspend.php",
            data: "id=" + id_suspend + "&suspend=" + checked_suspend,
            method: "POST",
            success: function(){
                alert("Changes update successfully");
                enable();
            }
            //complete: enable()

        });
    });
    $('#main_part').on('click', '.data_csv', function(){
        var checked_data, id_data;
        id_data = $(this).siblings('.id_page_input').attr('value');
        if($(this).val() == 1){
            checked_data = 0;
            $(this).val(0);
        }else{
            checked_data = 1;
            $(this).val(1);
        }
        $.ajax({
            beforeSend: disable(),
            url: "/wp-content/themes/Culture_FX/admin-panel/data.php",
            data: "id=" + id_data + "&data=" + checked_data,
            method: "POST",
            success: function(){
                alert("Changes update successfully");
                enable();
            }
        });
    });
});
