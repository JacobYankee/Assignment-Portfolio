<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<?php
session_start();
//configure session values
if (isset($_POST["id"]) && strlen($_POST["id"]) > 1)
{
    $id = $_POST["id"];
    $_SESSION["id"] = $id;
}
else
{
    $id = NULL;
}
if (isset($_SESSION["id"]))
{
    $id = $_SESSION["id"];
}
if (isset($_POST["pwd"]) && strlen($_POST["pwd"]) > 1)
{
    $pwd = $_POST["pwd"];
    $_SESSION["pwd"] = $pwd;
}
else{
    $pwd = NULL;
}
if (isset($_SESSION["pwd"]))
{
    $pwd = $_SESSION["pwd"];
}
//connect to database
$db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q5");

//profile update call
if (isset($_POST["pUp"]) && isset($_POST["nUp"]) && isset($_POST["aUp"]) && isset($_POST["cUp"]))
{
    $p = $_POST["pUp"];
    $n = $_POST["nUp"];
    $a = $_POST["aUp"];
    $c = $_POST["cUp"];
    $profile = "UPDATE users SET `uPwd` = '$p', `uName` = '$n', `uAddress` = '$a', `uCard` = '$c' WHERE `id` = '$id'";
    $update = mysqli_query($db, $profile);
}

$access = 0;
//query to get all values
$query = "SELECT * FROM users";
$result = mysqli_query($db, $query);
$numrows = mysqli_num_rows($result);

if ($id != NULL && $pwd != NULL)
{
for ($i = 0; $i < $numrows; $i++)
{
    $row = mysqli_fetch_assoc($result);
    $user = $row["id"];
    $pass = $row["uPwd"];
    $name = $row["uName"];

    if ($id == $user && $pwd == $pass)
        {
        $access = 1;
        print "<title>Home</title>
            <h1>Home Page</h1> <hr> <br>
            <h2>Welcome, $name!</h2> <br>";
        print"<a href = http://localhost/q5home.php><button>Home</button></a>
            <a href = http://localhost/q5shop.php><button>Shop</button></a>
            <a href = http://localhost/q5orders.php><button>Orders</button></a>
            <a href = http://localhost/q5profile.php><button>Profile</button></a>
            <br>
            <a href = http://localhost/q5login.php><button>Logout</button></a>";
        }
    }
}
    if ($access != 1)
    {
        print "<title>Login error</title>";
        print "<h1>Error: Invalid username or password.</h1>";
        print "<a href = \"http://localhost/q5login.php\"><button>Return to login</button></a>";
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