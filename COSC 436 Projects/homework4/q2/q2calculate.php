<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
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
        <h3>Your results:</h3>
        <hr>
        <?php
        //get values from cookies
        if (isset($_COOKIE["credits"]))
            $credit = $_COOKIE["credits"];
        else
            $credit = -1;
        if (isset($_COOKIE["grad"]))
            $grad = $_COOKIE["grad"];

        //get value from form
        if (isset($_POST["state"]))
            $state = $_POST["state"];
        else
            $state = "off";
        $total = 0;
        $mult = 1;
        $cred = 0;
        //error checks, every error condition is checked individually so multiple can appear
        if ($credit < 1 || $credit > 18)
            echo"<h3>Error: Credits out of bounds</h3>";
        if ($grad == "off")
            echo"<h3>Error: Academic status null</h3>";
        if ($state == "off")
            echo"<h3>Error: State status null</h3>";
        else if ($credit > 0 && $credit < 19 && $grad != "off" && $state != "off")
            {
                echo"<div id =\"calc\">";
                echo"<table>";
                echo"<tr><th>Items</th><th>Values</th>";
                echo"<tr><td>Credits:</td><td>$credit</td></tr>";
                //determine bill costs through conditionals
                if ($grad == "ugrad")
                {
                    echo"<tr><td>Academic Status: </td><td>Undergrad, $200/credit</td></tr>";
                    $cred = 200;
                }
                else
                {
                    echo"<tr><td>Adacemic Status: </td><td>Graduate, $300/credit</td></tr>";
                    $cred = 300;
                }
                if ($state == "out")
                {
                    $mult = 2;
                    echo"<tr><td>State Status:</td><td>Out of State, credit fee doubled</td></tr>";
                }
                else
                    echo"<tr><td>State Status:</td><td>In State</td></tr>";
                $total = $mult * ($credit * $cred);
                //display total at bottom of table
                echo"<tr><td>Total:</td><td>$$total</td></tr>";
                echo"</table>";   
            }
        echo "</div>";  
        ?>
        <a href = "http://localhost/q2start.html"><button>Start over</button></a>
    </body>
</html>