<!DOCTYPE html>
<html>
    <head>
        <title>Add Page</title>
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
            form{
                margin-left:auto;
                margin-right:auto;
            }
        </style>
    </head>
    <body>
    <a href = "mainpage.php"><img src = "https://cdn.discordapp.com/attachments/1180984530451038319/1180984602895077476/Logo.png?ex=657f689e&is=656cf39e&hm=6fcfaf4c74fc340f51a6b0eb15a2632e820cf1c52e15f20cb64dd6207d2db4d0&" width = "15%"></a>
        <br>
        <p>Click above to return to the home page</p>
        <hr>
        <?php
        error_reporting(E_ALL& ~E_DEPRECATED);
        ini_set('display_errors', 'On');

        $db = mysqli_connect("cosc473project.coend9cuqsan.us-east-1.rds.amazonaws.com", "admin", "cosc473password", "projectSchema");

        $query = "SELECT * FROM passwords";
        $result = mysqli_query($db, $query);
        $numrows = mysqli_num_rows($result);

        if (isset($_POST["pass"]))
            $pass = $_POST["pass"];
        else
            $pass = "none";

        $access = 0;
        for ($i = 0; $i < $numrows; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $pwd = $row["pwd"];
            if ($pass == $pwd)
            {
                $access = 1;
        print"<h1>Add content:</h1>
        <form method = \"post\" action = \"update.php\">
            <label>Name:</label>
            <br>
            <input type = \"text\" name = \"name\" maxlength = \"60\" size = \"50\">
            <br>
            <label>Image Link:</label>
            <br>
            <input type = \"text\" name = \"img\" maxlength = \"200\" size = \"50\">
            <br>
            <input type = \"hidden\" name = \"price\" value = \"0\">
            <label>Short Description:</label>
            <br>
            <input type = \"text\" name = \"short\" maxlength = \"50\" size = \"50\">
            <br>
            <label>Long Description:</label>
            <br>
            <textarea name = \"long\" maxlength = \"500\" rows = \"6\" cols = \"50\"></textarea>
            <br>
            <input type = \"submit\">
        </form>";
            }

        }
        if ($access != 1)
        {
            print "<h1>Access denied.</h1>";
        }
        ?>
    </body>
</html>