<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<?php
    //destroy session to remove session data
    session_start();
    session_destroy();
    ?>
<html>
    <head>
        <title>Shopping Site</title>
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
    <body>
        <h1>Shopping Site</h1>
        <hr>
        <h3>Returning user</h3>
        <form method = "post" action = "http://localhost/q5home.php">
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
        <a href = "http://localhost/q5register.php"><button>Register</button></a>
    </body>
</html>
