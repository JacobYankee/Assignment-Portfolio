<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <style>
            body{
                text-align:center;
                font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                color: ghostwhite;
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
            table{
                margin-left:auto;
                margin-right:auto;
                border-collapse:collapse;
                text-align: left;
            }
            table, th, td
            {
                width: 80%;   
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
        <?php
            echo "<title>Itemized bill</title>";
            echo "<h1>University Cost Calculator Results</h1>";
            echo "<br>";
            echo "<hr>";
            echo "<h3>Below are your results in an itemized bill. If an error message occurs, go to the previous page and fix the errors.</h3>";
            //get credits, isset check is not necessary as an empty value is considered less than 1
            $credit = $_POST["credits"];
            //get values from form, check for any unchecked radio buttons and checkboxes
            if (isset($_POST["rad"]))
                $grad = $_POST["rad"];
            else
                $grad = "off";

            if (isset($_POST["state"]))
                $state = $_POST["state"];
            else
                $state = "off";

            if (isset($_POST["dorm"]))
                $dorm = $_POST["dorm"];
            else
                $dorm = "off";

            if (isset($_POST["dine"]))
                $dine = $_POST["dine"];
            else
                $dine = "off";

            if (isset($_POST["park"]))
                $park = $_POST["park"];
            else
                $park = "off";
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

            //itemized bill, confirm all error checks have been successfully passed
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
                if ($dorm == "on")
                {
                    $total += 1000;
                    echo"<tr><td>Dormitory:</td><td>Yes, $1000</td></tr>";
                }
                else
                    echo"<tr><td>Dormitory:</td><td>No</td></tr>";
                if ($dine == "on")
                {
                    $total += 500;
                    echo"<tr><td>Dining:</td><td>Yes, $500</td></tr>";
                }
                else
                    echo"<tr><td>Dining:</td><td>No</td></tr>";
                if ($park == "on")
                {
                    $total += 200;
                    echo"<tr><td>Parking:</td><td>Yes, $200</td></tr>";
                }
                else
                    echo"<tr><td>Parking:</td><td>No</td></tr>";
                //display total at bottom of table
                echo"<tr><td>Total:</td><td>$$total</td></tr>";
                echo"</table>";
                
            }
        echo "</div>";  
        ?>
    </body>
</html>