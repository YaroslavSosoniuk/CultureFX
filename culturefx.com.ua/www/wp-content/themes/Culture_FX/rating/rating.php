<?php
/*Template name: rating
*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="/wp-content/themes/Culture_FX/rating/script.js" ></script>
    </head>
    <body>
        <div class="ratings">
            <span class="empty_star_background"><input type="radio" name="" value="1"></span>
            <span class="empty_star_background"><input type="radio" name="" value="2"></span>
            <span class="empty_star_background"><input type="radio" name="" value="3"></span>
            <span class="empty_star_background"><input type="radio" name="" value="4"></span>
            <span class="empty_star_background"><input type="radio" name="" value="5"></span>
        </div>
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
