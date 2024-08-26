<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
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
<?php
//connect to database, query to get all values
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q4");
    $query = "SELECT * FROM user";
    $result = mysqli_query($db, $query);
    $numrows = mysqli_num_rows($result);
//check if register form has been submitted
    if (isset($_POST["id"]))
        $id = $_POST["id"];
    else
        $id = NULL;

    if (isset($_POST["pwd"]))
        $password = $_POST["pwd"];
    else
        $password = NULL;

    if (isset($_POST["realName"]))
        $name = $_POST["realName"];
    else
        $name = NULL;

    if (isset($_POST["email"]))
        $email = $_POST["email"];
    else
        $email = NULL;

    //variable for registering
    $valid = 0;
    //if post values are null, load form
    if( $id == NULL && $password == NULL && $name == NULL && $email == NULL)
    {
        print "<h1>Register for an account</h1> <hr>";
        print "<form method = \"post\" action = \"http://localhost/q4register.php\">
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
                <input type = \"text\" name = \"realName\">
                <br>
                <label>Email</label>
                <br>
                <input type = \"text\" name = \"email\">
                <br>
                <input type = \"submit\" value = \"Register\">
                </form>";
    }
    else if($id != NULL && $password != NULL && $name != NULL && $email != NULL)
    {
        //loop through database to check if user ID is taken
        for($i = 0; $i < $numrows; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $user = $row["id"];

            if ($id == $user)
            {
                $valid = 1;
                print "<h1>Register for an account</h1> <hr>";
                print "<h3>Error: User ID already taken.</h3>";
                print "<form method = \"post\" action = \"http://localhost/q4register.php\">
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
                    <input type = \"text\" name = \"realName\">
                    <br>
                    <label>Email</label>
                    <br>
                    <input type = \"text\" name = \"email\">
                    <br>
                    <input type = \"submit\" value = \"Register\">
                    </form>";

            }

        }
        if ($valid == 0)
        {
            print "<h1>Registration successful.</h1>";
            $register = "INSERT INTO user (id, pwd, realName, email) VALUES ('$id', '$password', '$name', '$email')";
            $update = mysqli_query($db, $register);
            print "<a href = \"http://localhost/q4login.php\"><button>Return to login</button></a>";
        }
    }
?>
</body>
</html>
