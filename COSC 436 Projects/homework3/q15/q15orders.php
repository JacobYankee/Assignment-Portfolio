<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html>
    <head>
        <title>Restaruant Orders Portal</title>
        <link rel = "stylesheet" href = "q15.css">
</head>
<body>
    <?php
    //conenct to database
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h3q15");
    //query to get all values from passwords table
    $qPass = "SELECT * FROM passwords";
    $rPass = mysqli_query($db, $qPass);
    $nPass = mysqli_num_rows($rPass);
    //get password from form
    $user = $_POST["password"];
    $access = 0;
    //query to get all values from orders table
    $qOrd = "SELECT * FROM orders";
    $rOrd = mysqli_query($db, $qOrd);
    $nOrd = mysqli_num_rows($rOrd);
    //outer loop for password check
    for($i = 0; $i < $nPass; $i++)
        {
            $pRow = mysqli_fetch_assoc($rPass);
            $pas = $pRow["pwd"];
            if($user == $pas)
            {
            print"<h1>Restaurant Orders</h1>";
            //set access to 1 to prevent error message
            $access = 1;
            print"<table>";
            print"<tr><th>Order ID</th><th>Name</th><th>Address</th><th>Payment Info</th><th>Burger</th><th>Pizza</th><th>Soda</th>";
            //inner loop to create table from database
            for( $j = 0; $j < $nOrd; $j++)
                {
                    $oRow = mysqli_fetch_assoc($rOrd);
                    $id = $oRow["autoID"];
                    $name = $oRow["customer"];
                    $address = $oRow["locale"];
                    $card = $oRow["payment"];
                    $burger = $oRow["burger"];
                    $pizza = $oRow["pizza"];
                    $soda = $oRow["soda"];
                    print "<tr><td>$id</td><td>$name</td><td>$address</td><td>$card</td><td>$burger</td><td>$pizza</td><td>$soda</td></tr>";
                }
            print "</table>";
            print "<br>";
            //form to remove orders from database
            print "<form method = \"post\" action = \"http://localhost/q15update.php\">";
            print "<label>Enter order ID to remove: </label>";
            print "<input type = \"text\" name = \"id\" placeholder = \"Order ID...\">";
            print "<input type = \"submit\">";
            }
        }
        //print error message if password is not in database
    if ($access == 0)
        print "<h1>Access denied. Incorrect password.</h1>";
    ?>
</body>
</html>