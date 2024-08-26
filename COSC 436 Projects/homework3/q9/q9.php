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
                font-family: Verdana, sans-serif;
                background-color: tan;
            }
            img{
                width:500px;
                height:500px;
            }
            #content{
                background-color: oldlace;
                width:35%;
                margin-left: auto;
                margin-right: auto;
                border: 4px solid dimgray;
            }
            #time{
                background-color: linen;
                width: 20%;
                border: 3px solid lightgray;

                position: absolute;
                bottom:0;
                left: 750px;
            }
        </style>
    </head>
    <body>
        <div id = "content">
        <?php
        //random values to determine format and array value displayed
        $x = rand(1, 2);
        $y = rand(0, 3);
        //arrays containing images and quotes
        $img = array("https://upload.wikimedia.org/wikipedia/en/2/27/Bliss_%28Windows_XP%29.png", "https://img.freepik.com/free-photo/painting-mountain-lake-with-mountain-background_188544-9126.jpg",
        "https://t3.ftcdn.net/jpg/05/11/25/36/360_F_511253627_zuzpapnIVQueMx4eSL1ilAoH61OBgj0C.jpg","https://t3.ftcdn.net/jpg/05/35/47/38/360_F_535473874_OWCa2ohzXXNZgqnlzF9QETsnbrSO9pFS.jpg");
        $quote = array("I will be there no matter what. -Kylian Mbappe", "I owe you an apology. I wasn't really familiar with your game. -Shaquille O'Neal",
         "We have lost the impact of shame in our society. -David Aldridge", "You can't fool me. I am familiar with your game. -Shaquille O'Neal");
        //images
        if ($x == 1)
        {
            $randImg = $img[$y];
            echo "<title> Random Image </title>";
            echo "<h1> Random Image Format </h1>";
            echo "<h2> This session's random image is... </h2>";
            echo "<img src = '$randImg'>";
        }
        //quotes
        if ($x == 2)
        {
            $randQuote = $quote[$y];
            echo "<title> Random Quote </title>";
            echo "<h1> Random Quote Format </h1>";
            echo "<h2> This session's random quote is... </h2>";
            echo "<p> $randQuote </p>";
        }
        ?>
        </div>
        <!--Time done with php, note that we are not asked to make the time update at all-->
        <div id = "time">
            <?php
            date_default_timezone_set("America/Detroit");
            echo "<p>Date and time this page was last loaded at: ".date("m/d/Y h:i:sa") . "</p>";
            ?>
        </div>
    </body>
</html>