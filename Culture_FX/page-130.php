<?php
	$id_page=get_the_ID();
	$host = 'shevlyak.mysql.tools';
	$user = 'shevlyak_fxuser';
	$password = 'dsbda9ww';
	$conn = mysql_connect($host, $user, $password);	
	mysql_select_db('shevlyak_fxuser');
	$bd_id_avtor = mysql_query('SELECT id_user FROM user_page WHERE (id_page=\''.$id_page.'\')');
	$avtor_id = mysql_fetch_array($bd_id_avtor);
	$avtor_data = get_userdata($avtor_id['id_user']);
	$avtor = $avtor_data->first_name . ' ' . $avtor_data->last_name;
	$query = 'SELECT skill_meta FROM skills WHERE (id_page=\''.$id_page.'\')';
	$q = mysql_query($query);
	while($result = mysql_fetch_array ($q)) {
      $skills[] = $result['skill_meta'];
	}
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
	
        <form class='' action='/wp-content/themes/Culture_FX/bd_insert.php' method='post'>
            <h2>Common Ground Matching Systems</h2>
            <p class='center_text'>Exclusively For The Group: <span id='group'><?php echo get_the_title(); ?></span></p>
            <p class='center_text'>Your organizer: <span id='organizer'><?php echo $avtor; ?></span></p>

            <p class='dark_text'>Sing Up with your social account:</p>
            <button type='button' name='log_in_linkedin' class='log_in'><i class='fa fa-linkedin' aria-hidden='true'></i><span>Connect with Linkedin</span></button>
            <p class='dark_text text_line'>or</p>
			<input type='text' name='id_page' value='<?php echo $id_page; ?>' hidden>
            <p class='input_label'>First Name*</p>
            <input class='m_width' type='text' name='first_name' value='' required>

            <p class='input_label'>Last Name*</p>
            <input class='m_width' type='text' name='last_name' value='' required >

            <p class='input_label'>Email*</p>
            <input class='m_width' type='email' name='cul_email' value='' required>

            <p class='input_label'>LinkedIn.com Profile URL</p>
            <input type='url' name='linkedin_profile' value='' class='tooltip' title='Include help tip on where to find this info on linkedin'>

            <p class='input_label'>Create a Password*</p>
            <input type='password' name='cul_password' value='' required>
			
            <p class='input_label gender'>Gender*</p>
            <div class='gender_chose'>
                <input type='checkbox' class='gender_radio' name='gender' value='Male'>
                <label for='gender'>Male</label>
                <br>
                <input type='checkbox' class='gender_radio' name='gender' value='Female'>
                <label for='gender'>Female</label>
                <br>
                <input type='checkbox' class='gender_radio' name='gender' value='No preference'>
                <label for='gender'>No preference</label>
            </div>
            <br>

            <p class='input_label age' class='tooltip' title=' 18-29 , 30-39 , 40-49, 50+'>Your Age Range*</p>
            <div class='age_points'>
              <input type='checkbox' class='age_radio' name='age_change' value='18-29'>
              <label for='age_change' class='age_label'>18-29</label>
              <br>
              <input type='checkbox' class='age_radio' name='age_change' value='30-39'>
              <label for='age_change' class='age_label'>30-39</label>
              <br>
              <input type='checkbox' class='age_radio' name='age_change' value='40-49'>
              <label for='age_change' class='age_label'>40-49</label>
              <br>
              <input type='checkbox' class='age_radio' name='age_change' value='50+'>
              <label for='age_change' class='age_label'>50+</label>
              <br>
              <input type='checkbox' class='age_radio' name='age_change' value='No preference'>
              <label for='age_change' class='age_label'>No preference</label>
          </div>
          <p class='input_label'>General Area of Expertise or Occupation</p>
          <input type='text' name='expertise_or_occupation' value='' class='tooltip' title='Example : Doctor, Digital Markter, etc'>


          <p class='input_label'>Job Title/Position</p>
          <input type='text' name='job_title' value=''>

          <p class='input_label c-level-text'>Are You a C-level Executive?</p>
          <!-- <input type='text' name='c_level' value='' class='tooltip' title='Example : Are you a senior exec, founder, or director?'> -->
          <div class='c-level-input'>
              <input type='checkbox' name='c-level' value='Yes' id='yes_c_level'><label for='yes_c_level'>Yes</label><br>
              <input type='checkbox' name='c-level' value='No' id='no_c_level'><label for='no_c_level'>No</label><br>
              <input type='checkbox' name='c-level' value='Unsure' id='unsure_c_level'><label for='unsure_c_level'>Unsure</label>
          </div>

          <p class='input_label'>About Me: <span class='comment'>(Give a potential match your &#8220;30 second Elevator Pitch&#8221;)</span></p>
          <textarea name='about' ></textarea>

          <p  class='input_label'>On average. how long will it take you to complete a meeting with a mutual mathc?</p>


          <input type='radio' name='receive_match' value='Same Day' checked>
          <label for=''>Same Day</label>
          <br>

          <input type='radio' name='receive_match' value='2-3 Days'>
          <label for=''>2-3 Days</label>
          <br>

          <input type='radio' name='receive_match' value='That week'>
          <label for=''>That week</label>
          <br>

          <input type='radio' name='receive_match' value='Within 2 weeks'>
          <label for=''>Within 2 weeks</label>
          <br>

          <input type='radio' name='receive_match' value='Within 1 month'>
          <label for=''>Within 1 month</label>
          <br>

          <input type='radio' name='receive_match' value='Within 1 month'>
          <label for=''>Within 2 months</label>
          <br>

          <input type='radio' name='receive_match' value='Varies Wildly, I have a very busy schedule'>
          <label for=''>Varies Wildly, I have a very busy schedule</label>
          <br>

          <div class='input_text_italic'><p>&quot;In a world with a lot of noise, it&#8217;s hard to find, connect with, and network with people that have the talent and skills, and mindset tou,re looking for at that moment.	&quot;</p></div>

          <div class='text_input'><p>Select up to 3 talents, skills, or professions you&#8217;re seeking in an ideal match, then select ip to 3 skills or talents you have to offer an ideal match.</p></div>

          <p class='input_label'>Select up to 3 talents or skills you want your ideal matches to have</p>
<?php
    $arr = array('w_value1','w_value2','w_value3','h_value1','h_value2','h_value3');
    $index = 0;
    foreach ($arr as $value)
    {     $index++;
    if($index==4){echo '<p class=\'input_label\'>Select up to 3 talents, skills, or expertise you have to offer an ideal match</p>';}
?>
<select name='<?php echo $value;?>'>
            <option selected hidden>
            <?php
            if($index==1 || $index ==4)  {
				echo 'Please Select what your’e looking for';
			}
			else {
            echo 'No preference';
			}
            ?></option>
			<?php
			foreach ($skills as $skill) {
			?>
            <option value='<?php echo $skill; ?>'><?php echo $skill; ?></option>
			<?php
			}
			?>
        </select>
<?php


}
?>



        <div class='join_now'>
            <p class='join_now_text'>By clicking Join now, you agree to share your contact information with the organizer of this group for future communication and data backup purposes and you agree to Common Ground Matching Systems’ User Agreement, Privacy Policy, and Cookie Policy.</p>
            <p style='text-align: center;'><input type='submit' name='' value='Join Now'></p>
        </div>


    </form>

</body>
</html>
