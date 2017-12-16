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
$db = mysql_connect ("shevlyak.mysql.ukraine.com.ua","shevlyak_fxuser","dsbda9ww");
mysql_select_db ("shevlyak_fxuser",$db);

/*echo '<pre>';
print_r($_POST);
echo '</pre>';*/

$keys_bd = array( 'id_page',
				  'first_name',
                  'last_name',
                  'email',
                  'linkedin_profile',
                  'password',
                  'gender',
                  'age_range',
                  'expertise_or_occupation',
                  'job_title',
                  'c_level',
                  'about',
                  'time_to_reach_out',
                  'w_value1',
                  'w_value2',
                  'w_value3',
                  'h_value1',
                  'h_value2',
                  'h_value3'
);
$keys_bd_text = "`".implode("`,`", $keys_bd)."`";
$data = $_POST;
foreach($data as &$elem) {
	if(empty($elem)) {
$elem = 'NULL';
	
	}
	if(is_array($elem)) {
		$elem = implode(";", $elem);
	}

}

$data_val = "'".implode("','", $data)."'";

/*echo '<pre>';
print_r($keys);
echo '</pre>';
echo '<pre>';
print_r($data_val);
echo '</pre>';*/
/*$keys = array_keys($data);
$data_keys = "`".implode("`,`", $keys)."`";*/

$query ="INSERT INTO  `wp_cultures` ({$keys_bd_text}) VALUES  ({$data_val})";
mysql_query($query) or die('Eror');
echo '
<img class="thank_reg" src="/wp-content/uploads/2017/11/600_435691150.png">
<h1 class="thank_for_reg">Thank you for registration!</h1>
<h2 class="thank_for_reg_after">‘Thank you for joining using Matching Tool. We will be looking through our database for a match. As soon as we find a match for you, we will send an email to your inbox, so make sure to add ‘info@culture-fx.com to your email unblock list. You may close this window, and talk to you soon! ‘ - The Culture-FX.com Team. </h2>';

mysql_close($db);


?> 
</body>
</html>