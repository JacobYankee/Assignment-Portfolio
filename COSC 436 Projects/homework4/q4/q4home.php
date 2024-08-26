<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<?php
    session_start();
    //configure session values
    if (isset($_POST["id"]))
    {
        $id = $_POST["id"];
        $_SESSION["id"] = $id;
    }
    if (isset($_SESSION["id"]))
    {
        $id = $_SESSION["id"];
    }
    if (isset($_POST["pwd"]))
    {
        $pwd = $_POST["pwd"];
        $_SESSION["pwd"] = $pwd;
    }
    if (isset($_SESSION["pwd"]))
    {
        $pwd = $_SESSION["pwd"];
    }
    $access = 0;
    //database query
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q4");
    $query = "SELECT * FROM user";
    $result = mysqli_query($db, $query);
    $numrows = mysqli_num_rows($result);

    for($i = 0; $i < $numrows; $i++)
    {
        $row = mysqli_fetch_assoc($result);
        $user = $row["id"];
        $pass = $row["pwd"];
        $name = $row["realName"];

        if($id == $user && $pwd == $pass)
        {
            $access = 1;
            print "<title>Home</title>";
            print "<h1>Home Page</h1> <hr> <br>";
            print "<h2>Hello, $name!</h2> <br>";
            print "<a href = http://localhost/q4home.php><button>Home</button></a>";
            print "<a href = http://localhost/q4profile.php><button>Profile</button></a>";
            print "<a href = http://localhost/q4login.php><button>Logout</button></a>";
        }
    }

    //error message
    if ($access != 1)
    {
        print "<title>Login error</title>";
        print "<h1>Error: Invalid username or password.</h1>";
        print "<a href = \"http://localhost/q4login.php\"><button>Return to login</button></a>";
    }
?>
<html>
    <head>
    <style>
            body{
                text-align:center;
                background-color:azure;
                font-family: Helvetica, sans-serif;
            }
            form{
                font-size:125%;
            }
            input{
                font-size:80%;
            }
            button{
                font-size:110%;
            }
            hr{
                height:2px;
                border-width:0;
                background-color: midnightblue;
            }
        </style>
    </head>
</html>