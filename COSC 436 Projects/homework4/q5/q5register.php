<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<?php
session_start();
//connect to database, query to get all values
$db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q5");
$query = "SELECT * FROM users";
$result = mysqli_query($db, $query);
$numrows = mysqli_num_rows($result);

//check if register form has been submitted to make sure the user has a unique ID
//store every entered value as a session value
//in the event the ID is a duplicate
if (isset($_POST["id"]))
    $id = $_POST["id"];
else
    $id = NULL;

if (isset($_POST["pwd"]))
{
    $pwd = $_POST["pwd"];
    $_SESSION["pwd"] = $pwd;
}
else
    $pwd = NULL;

if (isset($_POST["name"]))
{
    $name = $_POST["name"];
    $_SESSION["name"] = $name;
}
else
    $name = NULL;

if (isset($_POST["address"]))
{
    $address = $_POST["address"];
    $_SESSION["address"] = $address;
}
else
    $address = NULL;

if (isset($_POST["card"]))
{
    $card = $_POST["card"];
    $_SESSION["card"] = $card;
}
else
    $card = NULL;

//get session values
if (isset($_SESSION["pwd"]))
    $p = $_SESSION["pwd"];
else
    $p = NULL;

if (isset($_SESSION["name"]))
    $n = $_SESSION["name"];
else
    $n = NULL;

if (isset($_SESSION["address"]))
    $a = $_SESSION["address"];
else
    $a = NULL;

if (isset($_SESSION["card"]))
    $c = $_SESSION["card"];
else
    $c = NULL;
?>
<html>
    <head>
        <title>Register</title>
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
        <?php
        //variable for registering
        $valid = 0;
        //if post values are null, load empty form
        if ($id == NULL && $pwd == NULL && $name == NULL && $address == NULL && $card == NULL)
        {
            print "<h1>Register for an account</h1> <hr>";
        print "<form method = \"post\" action = \"http://localhost/q5register.php\"><fieldset><legend>User Info</legend>
                <label>User ID</label>
                <br>
                <input type = \"text\" name = \"id\">
                <br>
                <label>Password</label>
                <br>
                <input type = \"text\" name = \"pwd\">
                <br>
                <label>Name</label>
                <br>
                <input type = \"text\" name = \"name\">
                <br>
                <label>Address</label>
                <br>
                <input type = \"text\" name = \"address\">
                <br>
                <label>Credit Card</label>
                <br>
                <input type = \"text\" name = \"card\">
                <br>
                <input type = \"submit\" value = \"Register\">
                </fieldset></form>";
        }
        else if ($id != NULL && $pwd != NULL && $name != NULL && $address != NULL && $card != NULL)
        {
            //loop through database, check if user ID is taken
            for ($i = 0; $i < $numrows; $i++)
            {
                $row = mysqli_fetch_assoc($result);
                $user = $row["id"];

                if ($id == $user)
                {
                    $valid  = 1;

                    print "<h1>Register for an account</h1> <hr>
                    <h3>Error: User ID already taken.</h3>";
        print "<form method = \"post\" action = \"http://localhost/q5register.php\"><fieldset><legend>User Info</legend>
                <label>User ID</label>
                <br>
                <input type = \"text\" name = \"id\">
                <br>
                <label>Password</label>
                <br>
                <input type = \"text\" name = \"pwd\" value = \"$p\">
                <br>
                <label>Name</label>
                <br>
                <input type = \"text\" name = \"name\" value = \"$n\">
                <br>
                <label>Address</label>
                <br>
                <input type = \"text\" name = \"address\" value = \"$a\">
                <br>
                <label>Credit Card</label>
                <br>
                <input type = \"text\" name = \"card\" value = \"$c\">
                <br>
                <input type = \"submit\" value = \"Register\">
                </fieldset></form>";
                }
            }

           if ($valid == 0)
            {
            print "<h1>Registration Successful.</h1>";
            $register = "INSERT INTO users (id, uPwd, uName, uAddress, uCard) VALUES ('$id', '$pwd', '$name', '$address', '$card')";
            $update = mysqli_query($db, $register);
            print "<a href = \"http://localhost/q5login.php\"><button>Return to login</button></a>";
            } 
        }
        ?>
    </body>
</html>