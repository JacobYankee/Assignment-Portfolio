<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<?php
if (isset($_POST["rad"]))
{
$grad = $_POST["rad"];
setcookie("grad", $grad, time() + 60 * 10);
}
else
    $grad = "off";
    setcookie("grad", $grad, time() + 60 * 10);
?>
<html lang="en">
    <head>
        <title>University Cost Calculator</title>
        <style>
            body{
                text-align:center;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                color:ghostwhite;
	            font-size:110%;
	            background-image:url('https://www.emich.edu/communications/images/zoom-wallpapers/emu-background-option-5.jpg');
	            background-size: 1920px 1080px;
	            background-repeat:no-repeat;
            }
            h1, h3{
	            background-color:seagreen;
	            width:35%;
	            text-align:center;
	            margin-left:auto;
	            margin-right:auto;
	            border: 5px solid white;
	            padding:5px;
	        }
            hr{
	            height:2px;
	            border-width:0;
	            color:black;
	            background-color:lawngreen;
	        }
            #calc{
	            background-color:seagreen;
	            width:20%;
	            text-align:center;
	            margin-left:auto;
	            margin-right:auto;
	            border: 5px solid white;
	            padding:5px;
	        }
        </style>
    </head>
    <body>
        <h1>University Cost Calculator</h1>
        <h3>Get started with calculating your tuition fee</h3>
        <hr>
        <div id = "calc">
            <h2>Step 3: State</h2>
            <form method = "post" action = "http://localhost/q2calculate.php">
            <input type = "radio" name = "state" value = "in">In State</input>
            <input type = "radio" name = "state" value = "out">Out of State</input>
                <br>
                <input type = "submit">
            </form>
        </div>
    </body>
</html>