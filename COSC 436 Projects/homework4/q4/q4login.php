<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<?php
date_default_timezone_set("America/New_York");
session_start();
    //database query
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q4");
    $query = "SELECT * FROM user";
    $result = mysqli_query($db, $query);
    $numrows = mysqli_num_rows($result);
    //check is session variables exist
    if (isset($_SESSION["id"]) && isset($_SESSION["pwd"]))
    {
        $id = $_SESSION["id"];
        $pwd = $_SESSION["pwd"];

        //update visits count and last visit time
        for ($i = 0; $i < $numrows; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $user = $row["id"];
            $pass = $row["pwd"];
            $vis = $row["pageVisits"];
            $date = date("l, m/d/Y @ h:ia");
            if ($id == $user && $pwd == $pass)
            {
                $vis = $vis +1;
                $visits = "UPDATE user SET `pageVisits` = '$vis', `lastVisit` = '$date' WHERE `id` = '$id'";
                $update = mysqli_query($db, $visits);
            }
        }
    }
    session_destroy();
 ?>
<html>
    <head>
        <title>Login Page</title>
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
    <body>
        <h1>Cool Website</h1>
        <hr>
        <h3>Returning user</h3>
        <form method = "post" action = "http://localhost/q4home.php">
            <label>User ID</label>
            <br>
            <input type = "text" name = "id">
            <br>
            <label>Password</label>
            <br>
            <input type = "text" name = "pwd">
            <br>
            <input type = "submit" value = "Login">
        </form>
        <br>
        <h4>New user? Click here!</h4>
        <a href = "http://localhost/q4register.php"><button>Register</button></a>
    </body>
</html>
                        
