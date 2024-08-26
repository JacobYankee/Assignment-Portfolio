<!DOCTYPE html>
<html>
    <head>
        <title>Make-Believe Indie Dev Website</title>
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
            #admin{
                position: fixed;
                bottom: 0;
                right: 0;
            }
        </style>
    </head>
    <body>
        <a href = "mainpage.php"><img src = "https://cdn.discordapp.com/attachments/1180984530451038319/1180984602895077476/Logo.png?ex=657f689e&is=656cf39e&hm=6fcfaf4c74fc340f51a6b0eb15a2632e820cf1c52e15f20cb64dd6207d2db4d0&" width = "15%"></a>
        <br>
        <h1>Welcome to the Make-Believe Indie Dev Website!!</h1>
        <h2>We're a small team in Michigan making very real and very playable games</h2>
        <h3>All of our available titles can be found on our itch.io page below</h3>
        <a href = "https://vanilladeluxe.itch.io" target = "_blank"><img src = "https://upload.wikimedia.org/wikipedia/commons/thumb/7/79/Itch.io_logo.svg/2560px-Itch.io_logo.svg.png" width = "15%"></a>
        <br>
        <hr>
        <?php
        $db = mysqli_connect("cosc473project.coend9cuqsan.us-east-1.rds.amazonaws.com", "admin", "cosc473password", "projectSchema");

        $query = "SELECT * FROM storeItems";
        $result = mysqli_query($db, $query);
        $numrows = mysqli_num_rows($result);

        print "<table>";
        print "<tr>";
        for($i = 0; $i < $numrows; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $id = $row["id"];
            $name = $row["itemName"];
            $short = $row["shortDesc"];
            $img = $row["imgLink"];
            if ($i % 3 ==0)
                {
                    print "</tr><tr>";
                }
                print "<td>";
                print "<div>
                <form method = \"get\" action = \"itempage.php\">
                <input type = \"hidden\" name = \"id\" value = \"$id\">
                <input type = \"image\" src = \"$img\" width = \"40%\">
                </form>
                <h3>$name</h3>
                <h4>$short<h4>
                </div>";
                print "</td>";
        }
        print "</tr></table>";
        ?>
        <a href = "login.html" id = "admin"><button>Admin portal</button></a>
    </body>
</html>