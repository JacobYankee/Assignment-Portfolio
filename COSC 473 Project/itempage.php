<!DOCTYPE html>
<html>
    <head>
    <style>
            body{
                text-align:center;
                background-color: tomato;
                color: white;
                font-family: Tahoma, sans-serif;
            }
            hr{
				height:2px;
				border-width:0;
				color:black;
				background-color:orangered;
				}
            img:hover{
                width: 16%;
            }
        </style>
    </head>
    <body>
    <a href = "mainpage.php"><img src = "https://cdn.discordapp.com/attachments/1180984530451038319/1180984602895077476/Logo.png?ex=657f689e&is=656cf39e&hm=6fcfaf4c74fc340f51a6b0eb15a2632e820cf1c52e15f20cb64dd6207d2db4d0&" width = "15%"></a>
        <br>
        <p>Click above to return to the home page</p>
        <hr>
        <?php
        $itemID = $_GET["id"];
        $db = mysqli_connect("cosc473project.coend9cuqsan.us-east-1.rds.amazonaws.com", "admin", "cosc473password", "projectSchema");

        $query = "SELECT * FROM storeItems";
        $result = mysqli_query($db, $query);
        $numrows = mysqli_num_rows($result);
        for($i = 0; $i < $numrows; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $id = $row["id"];
            $name = $row["itemName"];
            $short = $row["shortDesc"];
            $long = $row["longDesc"];
            $price = $row["price"];
            $img = $row["imgLink"];
            
            if ($itemID == $id)
            {
                print "<title>$name</title>";
                print "<img src = \"$img\"style = \"width:20%; float: left; margin-left: 200px;\">";
                print "<h1 style = \"width:40%; margin-left:700px;\"><u>$name</u></h1>
                <h2 style = \"width:40%; margin-left:700px;\">$short</h2>
                <br>
                <h3 style = \"width:40%; margin-left:690px;\">$long</h3>";
            }
        }
        ?>
    </body>
</html>