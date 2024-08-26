<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html lang = "en-US">
    <head>
        <style>
             body{
                text-align:center;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
                background-color:lightgoldenrodyellow;
            }
            hr{
                height:2px;
				border-width:0;
				color:darkslategray;
				background-color:darkslategray;
            }
            table{
                margin-left:auto;
                margin-right:auto;
                border-collapse:collapse;
                background-color:snow;
            }
            table, th, td
            {
                border: 1px solid darkslategray;
            }
            .row:hover{
                background-color:lawngreen;
            }
        </style>
    </head>
    <body>
        <?php
        echo "<title> Compound Interest Results </title>";
        echo "<h1> Compound Interest Results </h1>";
        echo "<hr>";
        //get values, if no value entered set to zero
        if (strlen($_POST["p"]) > 0)
            $p = $_POST["p"];
        else
            $p = 0;
        if (strlen($_POST["r"]) > 0)
            $r = $_POST["r"];
        else
            $r = 0;
        if (strlen($_POST["n"]) > 0)
            $n = $_POST["n"];
        else
            $n = 0;
        echo "<p> Your inputs were $p dollars with a $r% interest rate over $n years</p>";
        echo "<p>Your money growth over the years looks like...</p>";
        echo "<table>";
        echo "<tr><th>Year</th><th>Money</th>";
        //loop through years running the formula for every year from 1 to n
        for ($i = 1; $i <= $n; $i++)
            {
                $x = $p * pow(1+ ($r / 100), $i);
                echo "<tr class = \"row\"><td>$i</td><td>$$x</td></tr>";
            }
        echo "</table>";
        ?>
    </body>
</html>