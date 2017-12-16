<?php
/*Template name: email
*/
?>
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
        .confirmed_skill{
            background: url(/wp-content/uploads/2017/12/have_skill_email.png);
        }
        .not_confirmed_skill{
            background: url(/wp-content/uploads/2017/12/havent_skill_email.jpg);
        }
        .confirmed_skill, .not_confirmed_skill{
            background-size: 15px 15px;
            background-repeat: no-repeat;
            background-position: 0 0;
        }
	</style>
    <center class="wrapper" style="-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #ffffff; table-layout: fixed; width: 100%;">
        <div class="content" style="max-width: 600px; background: #fff;">
            <table class="logo">
                <tr>
                    <td><img src="/wp-content/uploads/2017/11/600_435691150.png" alt="logo_culture" style="display: block; width: 40%; height: auto; margin: 10px auto 0;"></td>
                </tr>
                <tr>
                    <td><p style="font-size:18px; text-align: center; margin: 0;">We found a match!</p></td>
                </tr>
                <tr>
                    <td><p style="font-size:18px; text-align: center; margin: 20px 0 0;">Based on the qualities you were looking for,<br>
                        we found a <span id="percent_of_match" style="font-size: 20px; color: #007e00; text-decoration: underline;">100%</span> Match for you!</p></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td><p style="font-size: 18px; text-align: left">Your match says they have expertise in the following areas:</p></td>
                </tr>
                <tr>
                    <td><p class="first_skill_of_match confirmed_skill" style="font-size: 18px; text-align:center; padding-left: 20px; margin: 10px auto; width: 60%;">Entertainment</p></td>
                </tr>
                <tr>
                    <td><p class="second_skill_of_match not_confirmed_skill" style="font-size: 18px; text-align:center; padding-left: 20px; margin: 10px auto; width: 60%;">Business Owner</p></td>
                </tr>
                <tr>
                    <td><p class="third_skill_of_match confirmed_skill" style="font-size: 18px; text-align:center; padding-left: 20px; margin: 10px auto; width: 60%;">Marketing, Advertising, SEO</p></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td><p style="font-size: 18px; text-align:left; margin: 5px auto;">Your Matche`s Name: <span id="name_of_matcher">Dan Smith</span></p></td>
                </tr>
                <tr>
                    <td><p style="font-size: 18px; text-align:left; margin: 5px auto;">LinkedIn Prfile: <a href="" target="_blank" id="linkedin_of_matcher" style="color:#1a0db5;">LinkedIn.com/in/dansmith</a></p></td>
                </tr>
            </table>
        </div>
    </center>
</body>
</html>
