<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<?php
    date_default_timezone_set("America/New_York");
    session_start();
    //get session values
    if (isset($_SESSION["id"]))
    {
        $id = $_SESSION["id"];
    }
    if (isset($_SESSION["pwd"]))
    {
        $pwd = $_SESSION["pwd"];
    }

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
        $email = $row["email"];
        $vis = $row["pageVisits"];
        $date = $row["lastVisit"];

        if($id == $user && $pwd == $pass)
        {
            print "<title>$id's profile</title>";
            print "<h1>Profile Page</h1> <hr> <br>";
            print "<h2>Hello, $name!</h2>";
            print "<h2> User email: $email</h2>";
            print "<h3>Total profile visits: $vis </h3>";
            print "<h4>Last visit time: $date</h4>";
            print "<a href = http://localhost/q4home.php><button>Home</button></a>";
            print "<a href = http://localhost/q4profile.php><button>Profile</button></a>";
            print "<a href = http://localhost/q4login.php><button>Logout</button></a>";
        }
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