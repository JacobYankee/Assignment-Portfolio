<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<?php
    //configure session values
    session_start();
if (isset($_SESSION["id"]))
{
    $id = $_SESSION["id"];
}
if (isset($_SESSION["pwd"]))
{
    $pwd = $_SESSION["pwd"];
}

    //database query
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q5");
    $query = "SELECT * FROM items";
    $result = mysqli_query($db, $query);
    $numrows = mysqli_num_rows($result);
    //create shop page from database
    print"<title>Shop Page</title>";
            print "<h1>Shop Page</h1><hr><br>";
            print "<h3>Select from our wares below!</h3>";
    print"<table>
    <tr><th>Check</th><th>Item Name</th><th>Price</th><th>Amount</th></tr>
    <form method = \"post\" action = \"http://localhost/q5confirm.php\">";
    for($i = 0; $i < $numrows; $i++)
    {
        $row = mysqli_fetch_assoc($result);
        $iid = $row["iID"];
        $iname = $row["iName"];
        $iprice = $row["iPrice"];
        print "<tr><td><input type = \"checkbox\" name = \"check$iid\"></td>
        <td><label>$iname: </td><td>\$$iprice</label></td>
        <td><input type = \"text\" name = \"amt$iid\"></td></tr>";
    }
    print "</table><input type = \"submit\" value = \"Order\"></form><br>";
    print"<br><a href = http://localhost/q5home.php><button>Home</button></a>
    <a href = http://localhost/q5login.php><button>Logout</button></a>";
?>
<html>
    <head>
        <style>
            body{
                text-align:center;
                background-color: lightyellow;
                font-family: Arial, sans-serif;

            }
            div{
                width:180px;
                border: 1px solid black;
                margin-left:auto;
                margin-right:auto;
                background-color:white;
            }
            h4{
                margin-top:0em;
                margin-bottom:0em;
            }
            table{
                margin-left:auto;
                margin-right:auto;
                border: 1px solid goldenrod;
            }
            fieldset{
                margin-left:auto;
                margin-right:auto;
                width:20%;
                border: 2px solid goldenrod;
                background-color: lemonchiffon;
            }
            legend{
                background-color: palegoldenrod;
            }
            hr{
                height:2px;
                border-width:0;
                background-color: gold;
            }
        </style>
    </head>
</html>