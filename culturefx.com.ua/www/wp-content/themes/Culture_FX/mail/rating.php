<?php
require_once('../Db_connection.class.php');
$DB = new Db_connection();
$answer_to_db = $DB->db_select_where('mail_answers', 'id_user', $_POST['user_id']);
while($d = $answer_to_db->fetch_assoc()){
    if($d['id_pair'] == $_POST['pair_id']){
        if(!empty($d['answer_1']) || !empty($d['answer_2']) || !empty($d['answer_3']) || !empty($d['answer_4'])) header('Location: https://culture-fx.com/');
    }
}
    $DB->db_update_2('mail_answers', 'answer_1 = "' . $_POST['answer_1'] . '", answer_2 = "' . $_POST['first_group_radio'] . '", answer_3 = "' . $_POST['second_group_radio'] . '", answer_4 = "' . $_POST['text'] . '"', 'id_user = "' . $_POST['user_id'] . '" AND id_pair = "' . $_POST['pair_id'] . '"');
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <title>Culture</title>
        <link rel='stylesheet' href='/wp-content/themes/Culture_FX/style.css'>
        <link rel='stylesheet' type='text/css' href='/wp-content/themes/Culture_FX/tooltipster-master/dist/css/tooltipster.bundle.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <script type='text/javascript' src='http://code.jquery.com/jquery-1.10.0.min.js'></script>
        <script type='text/javascript' src='/wp-content/themes/Culture_FX/tooltipster-master/dist/js/tooltipster.bundle.min.js'></script>
        <!-- <script src='//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script> -->
        <script type='text/javascript' src='/wp-content/themes/Culture_FX/script.js'></script>
        <script src="/wp-content/themes/Culture_FX/mail/rating.js"></script>
        <script type='text/javascript'>
            $(document).ready(function(){
                $('.tooltip').tooltipster({
                    //    animation: 'fade',
                    //    delay: 200,
                    //    theme: 'tooltipster-punk',
                    trigger: 'click'
                });
            });
        </script>
    </head>
    <body>
        <img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
        <div class="ratings">
            <span class="empty_star_background"><input type="radio" name="" value="1"></span>
            <span class="empty_star_background"><input type="radio" name="" value="2"></span>
            <span class="empty_star_background"><input type="radio" name="" value="3"></span>
            <span class="empty_star_background"><input type="radio" name="" value="4"></span>
            <span class="empty_star_background"><input type="radio" name="" value="5"></span>
        </div>
        <form action="thank_you_rating.php" method="POST">
            <input name="rating_value" class="post_rate">
            <input type="hidden" value="<?php echo $_POST['user_id_2']; ?>" name="user_id">
            <input type="submit" value="Send">
        </form>
        <style>
            .ratings{
                margin: 100px auto;
                width: 125px;
                padding: 0;
                position: relative;
                display: flex;
                flex-direction: row;
                justify-content: center;
            }

            .ratings span{
                width:25px;
                height:25px;
                color: #000;
                display: block;
                text-align: left;
                position: relative;
                overflow: hidden;
                box-sizing: border-box;
            }
            .ratings span>input{
                position: absolute;
                width: 100%;
                height: 100%;
                margin: 0;
                opacity: 0;
                left: 0;
                right: 0;
                z-index: 100;
            }
            .empty_star_background{
                background: url(/wp-content/uploads/2017/12/emptystar.png);
                background-repeat: no-repeat;
                background-size: 25px 25px;
            }
            .filled_star{
                background: url(/wp-content/uploads/2017/12/filled_star.png);
                background-repeat: no-repeat;
                background-size: 25px 25px;
            }
            .ratings span>input:hover{
                cursor: pointer;
            }
        </style>
    </body>
</html>
