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
<?php
$num_user = $_POST['num_user'];
require_once('../Db_connection.class.php');
require_once('Send_html.class.php');
$DB = new Db_connection();
$Send_html = new Send_html();
$result = $DB->db_users_pair_check($_POST['user_id'], $_POST['user_pair_id']);
if($num_user == 1) {
    $num_pair_user = 2;
}
else {
    $num_pair_user = 1;
}
if(($result['result_offer1'] == NULL && $result['result_offer2'] == NULL) || $result['result_offer'.$num_pair_user] == '1'){
    $DB->db_update('user_pairs', 'result_offer1', '0', 'id', $result['id']);
    $DB->db_update('user_pairs', 'result_offer2', '0', 'id', $result['id']);
    $user_pair_info = $DB->db_select_where('wp_cultures', 'culture_id', $_POST['user_pair_id']);
    $user_pair_info = $user_pair_info->fetch_assoc();
    $Send_html->response_email($user_pair_info['email'], 'Matching Tool - Match Pass ( Mulligan )', 'Your recent match passed on the opportunity to meet. Don’t feel bad. Sometimes people are too busy and haven’t updated their settings. Or the match didn’t feel it was it was a fit for their current needs. Whatever the reason, sit, back, relax, and we’re scanning our database right now for new matches. No need to do anything more at this point. We’re looking for matches and you will receive an email once we’ve found one. Thank you.  - The Culture-FX.com Team');
    echo '
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h1 class="thank_for_reg">You passed this match</h1>';
}
else if($result['result_offer1'] == '0' || $result['result_offer2'] == '0'){
    echo '
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h1 class="thank_for_reg">Match was passed</h1>';
}
else if($result['result_offer'.$num_user] == '1'){
    echo '
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h1 class="thank_for_reg">Match was accepted</h1>';
}
?>

</body>
</html>