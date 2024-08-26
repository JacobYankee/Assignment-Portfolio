<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
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
    $query = "SELECT * FROM users";
    $result = mysqli_query($db, $query);
    $numrows = mysqli_num_rows($result);

    for($i = 0; $i < $numrows; $i++)
    {
        $row = mysqli_fetch_assoc($result);
        $user = $row["id"];
        $pass = $row["uPwd"];
        $name = $row["uName"];
        $address = $row["uAddress"];
        $card = $row["uCard"];

        if ($id == $user && $pwd == $pass)
        {
            print"<title>$id's profile</title>";
            print "<h1>Profile Page</h1> <hr><br>";
            print "<h2>$name's Profile</h2>";
            //inputs have an attribute known as readonly that does exactly what you'd expect, however that isn't covered in the notes so we'll have to improvise
            print"<form method = \"post\" action = \"http://localhost/q5home.php\">
                <fieldset><legend>Update user information</legend>
                <div>
                <h4>ID: $id</h4>
                <h4>(This can't be changed)</h4>
                </div>
                <br>
                <table>
                <tr><th><label>Password:</label></th>
                <td><input type = \"text\" name = \"pUp\" value = \"$pwd\"></td></tr>
                <tr><th><label>Name:</label></th>
                <td><input type = \"text\" name = \"nUp\" value = \"$name\"></td></tr>
                <tr><th><label>Address:</label></th>
                <td><input type = \"text\" name = \"aUp\" value = \"$address\"></td><tr>
                <tr><th><label>Credit Card:</label></th>
                <td><input type = \"text\" name = \"cUp\" value = \"$card\"></td></tr>
                </table>
                <input type = \"submit\" value = \"Update\">
                </fieldset></form><br>";
            print"<a href = http://localhost/q5home.php><button>Home</button></a>
                <a href = http://localhost/q5login.php><button>Logout</button></a>";
               
        }
    }
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