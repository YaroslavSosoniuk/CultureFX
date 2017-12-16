<?php
// <tr>
//     <td><p style="font-size: 16px; text-align:left; margin: 5px auto; color: #000;">Email: </p></td>
// </tr>
class View_mail
{
    function mail_template($procent, $user_similarities, $array_want, $array_want_2, $linkedin, $full_name, $email, $user_id, $user_pair_id, $num_user, $rating)
    {
        foreach ($array_want as $want) {
            $check = 0;
            foreach ($user_similarities as $similarity) {
                if($want == $similarity){
                    $check++;
                }
            }
            if($check == 0){
                $want_similarity[] = '

                    <li id=" third_skill_of_match " class="third " style="font-size: 16px; text-align:left; padding-left: 20px; padding-right: 20px; margin: 10px auto;  background:url(http://1083861.shevlyak.web.hosting-test.net/wp-content/uploads/2017/12/cross.png); background-size: 15px 15px; background-repeat: no-repeat; background-position: 100% 0; color: #000;">' . $want . '</li>';
            }
            else{
                $want_similarity[] = '

                    <li id=" third_skill_of_match " class="third " style="font-size: 16px; text-align:left; padding-left: 20px; padding-right: 20px; margin: 10px auto;  background:url(http://1083861.shevlyak.web.hosting-test.net/wp-content/uploads/2017/12/have_skill_email.png); background-size: 15px 15px; background-repeat: no-repeat; background-position: 100% 0; color: #000;">' . $want . '</li>';
            }
        }
        if($rating != '0') {
            $rating_block = '
                <table style="width: 100%;">
                    <tr>
                        <td>
                        <p style="width: 100%; text-align: center; font-size: 18px; color: #7e9a2c; margin: 0 0 10px;">User Reviews</p>
                        <p style="width: 100%; text-align: center; font-size: 16px; color: #9a9a9a;">Average rating:</p>
                        <p style="width: 100%; text-align: center; font-size: 20px; color: #9a9a9a; margin: 10px 0;">'. $rating .'</p>
                        <div class="ratings" style="width: 100%; display: flex; flex-direction: row; justify-content: center;">
                            <span class="empty_star_background" style="width:25px; height:25px; display: block; text-align: left; position: relative; overflow: hidden; box-sizing: border-box;background: url(); background-repeat: no-repeat; background-size: 25px 25px;"><input type="radio" name="rate" value="1" style="position: absolute; width: 100%; height: 100%; margin: 0; opacity: 0; left: 0; right: 0; z-index: 100;"></span>
                            <span class="empty_star_background" style="width:25px; height:25px; display: block; text-align: left; position: relative; overflow: hidden; box-sizing: border-box;background: url(); background-repeat: no-repeat; background-size: 25px 25px;"><input type="radio" name="rate" value="2" style="position: absolute; width: 100%; height: 100%; margin: 0; opacity: 0; left: 0; right: 0; z-index: 100;"></span>
                            <span class="empty_star_background" style="width:25px; height:25px; display: block; text-align: left; position: relative; overflow: hidden; box-sizing: border-box;background: url(); background-repeat: no-repeat; background-size: 25px 25px;"><input type="radio" name="rate" value="3" style="position: absolute; width: 100%; height: 100%; margin: 0; opacity: 0; left: 0; right: 0; z-index: 100;"></span>
                            <span class="empty_star_background" style="width:25px; height:25px; display: block; text-align: left; position: relative; overflow: hidden; box-sizing: border-box;background: url(); background-repeat: no-repeat; background-size: 25px 25px;"><input type="radio" name="rate" value="4" style="position: absolute; width: 100%; height: 100%; margin: 0; opacity: 0; left: 0; right: 0; z-index: 100;"></span>
                            <span class="empty_star_background" style="width:25px; height:25px; display: block; text-align: left; position: relative; overflow: hidden; box-sizing: border-box;background: url(); background-repeat: no-repeat; background-size: 25px 25px;"><input type="radio" name="rate" value="5" style="position: absolute; width: 100%; height: 100%; margin: 0; opacity: 0; left: 0; right: 0; z-index: 100;"></span>
                        </div>
                        </td>
                    </tr>
                </table>
            ';
        }
        if(empty($email)){
            $text = '<table>
            				<tr>
                				<td>
                                    <form class="" action="http://1083861.shevlyak.web.hosting-test.net/wp-content/themes/Culture_FX/mail/accept.php" method="post" style="text-align: center; display: inline; padding: 0 5px;">
                					    <input type="hidden" value="'.$user_id.'" name="user_id">
                					    <input type="hidden" value="'.$user_pair_id.'" name="user_pair_id">
                					    <input type="hidden" value="'.$num_user.'" name="num_user">
                						<input type="submit" value="Accept" style="cursor: pointer;  margin: 10px 0; position: relative;  font-size: 16px; font-weight: bold;  color: white;  text-decoration: none;  text-shadow: 0 -1px 1px #cc5500;  user-select: none; padding: 5px 20px;  outline: none;  border-radius: 1px;  background: linear-gradient(to left, rgba(0,0,0,.3), rgba(0,0,0,.0) 50%, rgba(0,0,0,.3)), linear-gradient(#d77d31, #fe8417, #d77d31);  background-size: 100% 100%, auto;  background-position: 50% 50%; box-shadow: inset #ebab00 0 -1px 1px, inset 0 1px 1px #ffbf00, #cc7722 0 0 0 1px, #000 0 10px 15px -10px; cursor: pointer;"/>
                					</form>
                                    <form class="" action="http://1083861.shevlyak.web.hosting-test.net/wp-content/themes/Culture_FX/mail/pass.php" method="post" style="text-align: center; display: inline; padding: 0 5px;">
                                        <input type="hidden" value="'.$user_id.'" name="user_id">
                                        <input type="hidden" value="'.$user_pair_id.'" name="user_pair_id">
                                        <input type="hidden" value="'.$num_user.'" name="num_user">
                                        <input type="submit" value="Pass" style="cursor: pointer; margin: 10px 0; position: relative;  display: inline-block;  font-size: 16px;   color: rgb(209,209,217);  text-decoration: none;  text-shadow: 0 -1px 2px rgba(0,0,0,.2);  padding: 5px 20px;  outline: none;  border-radius: 3px;  background: linear-gradient(rgb(110,112,120), rgb(81,81,86)) rgb(110,112,120);  box-shadow:   0 1px rgba(255,255,255,.2) inset,   0 3px 5px rgba(0,1,6,.5),   0 0 1px 1px rgba(0,1,6,.2); cursor: pointer;"/>
                                    </form>
                                </td>
            				</tr>
            			</table>';
            $email = '';
        }
        else{
            $text = '';
            $email = ' <tr>
                                <td><p style="font-size: 16px; text-align:left; margin: 5px 0; color: #000;">E-mail: ' . $email . '</p></td>
                            </tr>';
        }

        $html_template = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            	<meta http-equiv="X-UA-Compatible" content="IE=edge">
            	<meta name="viewport" content="width=device-width, initial-scale=1.0">
            	<link href="https://fonts.googleapis.com/css?family=Exo+2:600,700" rel="stylesheet">
            	<title>email</title>
            </head>
            <body style="Margin: 0; background-color: #ffffff; min-width: 100%; padding: 0;">
            	<style>

            	</style>
                <center class="wrapper" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #ffffff; table-layout: fixed; width: 100%;">
                    <div class="content" style="max-width: 600px; background: #fff;">
                        <table class="logo">
                            <tr>
                                <td><img src="http://1083861.shevlyak.web.hosting-test.net/wp-content/uploads/2017/11/600_435691150.png" alt="logo_culture" style="display: block; width: 40%; height: auto; margin: 10px auto 0;"></td>
                            </tr>
                            <tr>
                                <td><p style="font-size:16px; text-align: center; margin: 0; color: #000;">We found a match!</p></td>
                            </tr>
                            <tr>
                                <td><p style="font-size:16px; text-align: center; margin: 20px 0 0; color: #000;">Based on the qualities you were looking for,<br>
                                    we found a <span id="percent_of_match" style="font-size: 20px; color: #007e00; text-decoration: underline;">' . $procent . '%</span> Match for you!</p></td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td><p style="font-size: 16px; text-align: left; color: #000;">Your match says they have expertise in the following areas:</p></td>
                            </tr>
                            <tr>
                                <td>
                                    <ul style="font-size: 16px;">
                                        '. $want_similarity[0] . $want_similarity[1] . $want_similarity[2] .'
                                    </ul>
                                </td>
                            </tr>
                        </table>
                        <table style="width: 100%;">
                            <tr>
                                <td><p style="font-size: 16px; text-align:left; margin: 5px 0; color: #000;">Your Matche`s Name: <span id="name_of_matcher">' . $full_name . '</span></p></td>
                            </tr>
                            <tr>
                                <td><p style="font-size: 16px; text-align:left; margin: 5px 0; color: #000;">LinkedIn Profile: <a href="' . $linkedin . '" target="_blank" id="linkedin_of_matcher" style="color:#1a0db5;">' . $linkedin . '</a></p></td>
                            </tr>
                           ' . $email . '
                        </table>
            			<table>
            				<tr>
            					<td><p style="text-align:center; font-size: 16px; margin: 10px auto; color: #000;">Why don`t you reach out to your match and request a meeting for<br>a cyp of coffee to find where you two overlap?</p></td>
            				</tr>
            				<tr>
            					<td><p style="text-align:center; margin: 20px auto; font-size: 16px; color: #000;">We suggest making the strongest connections by:<br>Meet in person 1 on 1<br>Video Chat<br>Phone Call</p></td>
            				</tr>
            			</table>
            			<table>
            				<tr>
            					<td><p style="text-align:center; margin: 20px auto; font-size: 16px; color: #000;">Your Match is looking for Someone that has skills in:</p></td>
            				</tr>
                            <tr>
                                <td>
                                    <ul>
                                        <li style="font-size: 16px; color: #000; text-align: left;">' . $array_want_2[0] . '</li>
                                        <li style="font-size: 16px; color: #000; text-align: left;">' . $array_want_2[1] . '</li>
                                        <li style="font-size: 16px; color: #000; text-align: left;">' . $array_want_2[2] . '</li>
                                    </ul>
                                </td>
                            </tr>
            			</table>
            			<table>
            				<tr>
            					<td><p style="font-size: 16px; color: #000; text-align: center;">Go ahead and reach out today! Strike while the Iron`s hot...<br>You match has has your info too.<br>If you have questions email info@culture-fx.com</p></td>
            				</tr>
            			</table>' . $rating_block . $text . '

                    </div>
                </center>
            </body>
            </html>
            ';
        return $html_template;
    }
    function small_mail_template($message){
        $html_template = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            	<meta http-equiv="X-UA-Compatible" content="IE=edge">
            	<meta name="viewport" content="width=device-width, initial-scale=1.0">
            	<link href="https://fonts.googleapis.com/css?family=Exo+2:600,700" rel="stylesheet">
            	<title>email</title>
            </head>
            <body style="Margin: 0; background-color: #ffffff; min-width: 100%; padding: 0;">
            	<style>

            	</style>
                <center class="wrapper" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #ffffff; table-layout: fixed; width: 100%;">
                    <div class="content" style="max-width: 600px; background: #fff;">
                        <table class="logo">
                            <tr>
                                <td><img src="http://1083861.shevlyak.web.hosting-test.net/wp-content/uploads/2017/11/600_435691150.png" alt="logo_culture" style="display: block; width: 40%; height: auto; margin: 10px auto 0;"></td>
                            </tr>
                            <tr>
                                <td><p style="font-size:16px; text-align: left; margin: 20px 0 0; color: #000;">' . $message . '</p></td>
                            </tr>
                        </table>
                    </div>
                </center>
            </body>
            </html>
            ';
        return $html_template;
    }
    function check_match_mail($name, $email, $linkedin, $user_id, $pair_id){
        $html_template = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Exo+2:600,700" rel="stylesheet">
    <title>email</title>
</head>
<body style="Margin: 0; background-color: #ffffff; min-width: 100%; padding: 0;">
    <style>

    </style>
    <center class="wrapper" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #ffffff; table-layout: fixed; width: 100%;">
        <div class="content" style="max-width: 600px; background: #fff;">
            <table class="logo">
                <tr>
                    <td><img src="http://1083861.shevlyak.web.hosting-test.net/wp-content/uploads/2017/11/600_435691150.png" alt="logo_culture" style="display: block; width: 40%; height: auto; margin: 10px auto 0;"></td>
                </tr>
                <tr>
                    <td><p style="font-size:16px; text-align: center; margin: 0; color: #000;">Hi. Recently you were given a match by Culture-FX and we’d love to know if you’ve connected with them already?</p></td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td><p style="text-align:left; font-size: 16px; color: #000;">Your Match’s Contact Info</p></td>
                </tr>
                <tr>
                    <td><p style="text-align:left; font-size: 16px; color: #000;">Name: ' . $name . '</td>
                </tr>
                <tr>
                    <td><p style="text-align:left; font-size: 16px; color: #000;">Their Email Address: ' . $email .'</p></td>
                </tr>
                <tr>
                    <td><p style="text-align:left; font-size: 16px; color: #000;">LinkedIn Profile: <a href="' . $linkedin . '" target="_blank" id="linkedin_of_matcher" style="color:#1a0db5;">' . $linkedin . '</a></p></td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td><p style="text-align:left; font-size: 16px; color: #000; font-weight: bold;">If you’ve already met with this person, Click ‘Yes’ and a survey will be sent and we’ll start looking for your next match.</p></td>
                </tr>
                <tr>
                    <td>
                        <form action="http://1083861.shevlyak.web.hosting-test.net/wp-content/themes/Culture_FX/mail/response_of_match.php" method="post" style="width: 100%;">
                            <input type="hidden" name="user_id" value="' . $user_id . '">
                            <input type="hidden" name="pair_id" value="' . $pair_id . '">
                            <input type="hidden" name="meet" value="1">
                            <input type="submit" name="" value="Yes, we`ve already connected" style="display: block; margin: 10px auto; position: relative;  font-size: 16px; font-weight: bold;  color: white;  text-decoration: none;  text-shadow: 0 -1px 1px #cc5500;  user-select: none; padding: 5px 20px;  outline: none;  border-radius: 1px;  background: linear-gradient(to left, rgba(0,0,0,.3), rgba(0,0,0,.0) 50%, rgba(0,0,0,.3)), linear-gradient(#d77d31, #fe8417, #d77d31);  background-size: 100% 100%, auto;  background-position: 50% 50%; box-shadow: inset #ebab00 0 -1px 1px, inset 0 1px 1px #ffbf00, #cc7722 0 0 0 1px, #000 0 10px 15px -10px; cursor: pointer;">
                        </form>
                    </td>
                </tr>
            </table>
            <table style="width: 100%">
                <tr>
                    <td><p style="text-align:center; font-size: 16px; color: #000; font-weight: bold;">If you need more time to meet let us know when to check in again with you.</p></td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td>
                        <form action="http://1083861.shevlyak.web.hosting-test.net/wp-content/themes/Culture_FX/mail/response_of_match.php" method="post" style="width: 100%">
                        <div style="display: block; margin: 0px auto; width: 190px;">
                            <input type="radio" name="continiou_some_days" value="2-4 days" id="first" style="cursor: pointer;"><label for="first" style="color:#000; font-size: 16px; cursor: pointer;">2-4 days</label><br>
                            <input type="radio" name="continiou_some_days" value="5-7 days" id="second" style="cursor: pointer;"><label for="second" style="color:#000; font-size: 16px; cursor: pointer;">5-7 days</label><br>
                            <input type="radio" name="continiou_some_days" value="9 days" id="third" style="cursor: pointer;"><label for="third" style="color:#000; font-size: 16px; cursor: pointer;">9 days</label><br>
                            <input type="radio" name="continiou_some_days" value="14 days" id="fourth" style="cursor: pointer;"><label for="fourth" style="color:#000; font-size: 16px; cursor: pointer;">14 days</label><br>
                            <input type="radio" name="continiou_some_days" value="30 days" id="fifth" style="cursor: pointer;"><label for="fifth" style="color:#000; font-size: 16px; cursor: pointer;">30 days</label><br>
                            <input type="radio" name="continiou_some_days" value="Do not check in with me" id="sixth" style="cursor: pointer;"><label for="sixth" style="color:#000; font-size: 16px; cursor: pointer;">Do not check in with me.</label><br>
                            <input type="hidden" name="user_id" value="' . $user_id . '">
                            <input type="hidden" name="pair_id" value="' . $pair_id . '">
                            <input type="hidden" name="meet" value="0">
                            <input type="submit" name="" value="submit" style="display:block; margin: 10px auto; position: relative;  font-size: 16px; font-weight: bold;  color: white;  text-decoration: none;  text-shadow: 0 -1px 1px #cc5500;  user-select: none; padding: 5px 20px;  outline: none;  border-radius: 1px;  background: linear-gradient(to left, rgba(0,0,0,.3), rgba(0,0,0,.0) 50%, rgba(0,0,0,.3)), linear-gradient(#d77d31, #fe8417, #d77d31);  background-size: 100% 100%, auto;  background-position: 50% 50%; box-shadow: inset #ebab00 0 -1px 1px, inset 0 1px 1px #ffbf00, #cc7722 0 0 0 1px, #000 0 10px 15px -10px; cursor: pointer;">
                        </div>
                        </form>

                    </td>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <td><p style="font-size: 16px; color: #000;">To stop receiving matches at any time, click this link <form action="http://1083861.shevlyak.web.hosting-test.net/wp-content/themes/Culture_FX/mail/off_and_pause.php" method="POST" style="display: inline;">
                    <input type="hidden" name="user_id" value="' . $user_id . '">
                    <input type="hidden" name="selected" value="off">
                    <input type="submit" name="" value="HERE" style="border: 0; outline: none; background: transparent; font-size: 18px; text-decoration: underline; color: #4d90fe; cursor: pointer;">
                    </form> or to Pause your matching services for 2 weeks click
                    <form action="http://1083861.shevlyak.web.hosting-test.net/wp-content/themes/Culture_FX/mail/off_and_pause.php" method="POST" style="display: inline;">
                    <input type="hidden" name="user_id" value="' . $user_id . '">
                    <input type="hidden" name="selected" value="pause">
                    <input type="submit" name="" value="HERE" style="border: 0; outline: none; background: transparent; font-size: 18px; text-decoration: underline; color: #4d90fe; cursor: pointer;">
                    </form>.</p></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td></td>
                </tr>
            </table>
        </div>
    </center>
</body>
</html>

        ';
            return $html_template;
    }
    function survey_letter($user_id, $pair_id, $user_name, $user_id_2, $user_name_2){
        $html_template = '
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css?family=Exo+2:600,700" rel="stylesheet">
                <title>email</title>
            </head>
            <body style="Margin: 0; background-color: #ffffff; min-width: 100%; padding: 0;">
                <style>
                ::-webkit-textfield-decoration-container { }
                ::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                }
                ::-webkit-outer-spin-button {
                    -webkit-appearance: none;
                }
                ::-webkit-resizer {
                    display: none;
                }
                </style>
                <center class="wrapper" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #ffffff; table-layout: fixed; width: 100%;">
                    <div class="content" style="max-width: 600px; background: #fff;">
                        <table style="width:100%;">
                            <tr>
                                <td><p style="font-size: 16px; font-style: italic; color: #000; text-align: center; margin: 10px 0; font-weight: bold; ">Survey Questions</p></td>
                            </tr>
                            <tr>
                                <td><p style="font-size: 16px; font-weight:bold; text-align: center; color: #000; margin: 0 0 10px;">Survey For '. $user_name .' --- matching with --- '. $user_name_2 .'</p></td>
                            </tr>
                        </table>
                        <table style="width:100%;">
                            <tr>
                                <td><p style="font-size: 16px; font-weight: 500; text-align: center; color: #000; margin: 10px 20px;">We’d love to know about your match! Your feedback is valuable and we improve our tool based on your comments. Let us know how we did with this match so we can bring you better matches in the future.</p></td>
                            </tr>
                            <tr>
                                <td>
                                    <form action="http://1083861.shevlyak.web.hosting-test.net/wp-content/themes/Culture_FX/mail/rating.php" method="post" style="width: 100%;">
                                        <p style="font-size: 16px; color: #000; text-align: left;">1. What was the overall quality of this match?( Scale 1-10; 1 being the worst match and 10 being the best match.)</p>
                                        <input name="answer_1" type="number" min="1" max="10" step="1" value="5" style="outline: none; text-align: center; color: #000; border-radius: 3px; padding: 5px 20px;">
                                        <p style="font-size: 16px; color: #000; text-align: left;">2. Did you make a Valuable connection or Generate a lead for your business with this match?</p>
                                        <input type="radio" id="dont_find_connection" name="first_group_radio" value="I did not find a generate a lead nor did I make a valuable connection.">
                                        <label for="dont_find_connection" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;">I did not find a generate a lead nor did I make a valuable connection.</label><br>
                                        <input type="radio" id="generated_lead" name="first_group_radio" value="I generated a lead for my business.">
                                        <label for="generated_lead" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;"> I generated a lead for my business.</label><br>
                                        <input type="radio" id="found_connection" name="first_group_radio" value="I found a valuable connection.">
                                        <label for="found_connection" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;"> I found a valuable connection.</label><br>
                                        <input type="radio" id="connectioan_and_lead" name="first_group_radio" value="I found BOTH lead for my business AND a valuable connection.">
                                        <label for="connectioan_and_lead" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;"> I found BOTH lead for my business AND a valuable connection.</label><br>
                                        <input type="radio" id="not_sure" name="first_group_radio" value="I’m not sure yet.">
                                        <label for="not_sure" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;"> I’m not sure yet.</label><br>
                                        <p style="font-size: 16px; color: #000; text-align: left;">3. Tell us how frequent you want future matches to come?</p>
                                        <input type="radio" id="more_frequently" name="second_group_radio" value="More Frequently">
                                        <label for="more_frequently" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;">More Frequently</label><br>
                                        <input type="radio" id="less_frequently" name="second_group_radio" value="Less Frequentl">
                                        <label for="less_frequently" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;"> Less Frequently</label><br>
                                        <input type="radio" id="same_pace" name="second_group_radio" value="About the same pace">
                                        <label for="same_pace" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;"> About the same pace</label><br>
                                        <input type="radio" id="dont_know" name="second_group_radio" value="I don’t know yet">
                                        <label for="dont_know" style="font-size: 16px; color: #000; text-align: left; padding-left: 5px; cursor:pointer;">I don’t know yet</label><br>
                                        <p style="font-size: 16px; color: #000; text-align: left;">4. How do we improve? Any additional comments or feedback? </p>
                                        <textarea rows="10" cols="" name="text" style="outline: none; resize: none; font-size: 16px; width: 100%; color: #000;"></textarea>
                                        <input type="hidden" name="user_id" value="'. $user_id .'">
                                        <input type="hidden" name="user_id_2" value="'. $user_id_2 .'">
                                        <input type="hidden" name="pair_id" value="'. $pair_id .'">
                                        <input type="submit" value="Send" style="border: 0; outline: none; color: #fff; background: #4d5896; padding: 5px 20px; font-size: 16px; display: block; margin: 10px auto; cursor: pointer;">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </center>
            </body>
        </html>

        ';
        return $html_template;
    }
}
