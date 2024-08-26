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
    <h1>Restaurant Orders</h1>
    <?php
    //connect to database
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h3q15");
        //obtain id value from form
        $id = $_POST["id"];
        //query to delete value from orders table
        $qUpd = "DELETE FROM orders WHERE `autoID` = '$id'";
        $rUpd = mysqli_query($db, $qUpd);
        //query to obtain all values from orders table
        $qOrd = "SELECT * FROM orders";
        $rOrd = mysqli_query($db, $qOrd);
        $nOrd = mysqli_num_rows($rOrd);
        print"<table>";
        print"<tr><th>Order ID</th><th>Name</th><th>Address</th><th>Payment Info</th><th>Burger</th><th>Pizza</th><th>Soda</th>";
        //loop to print values from orders table
        for($i = 0; $i < $nOrd; $i++)
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
    ?>
    <br>
    <!--form to get order ID to remove from database-->
    <form method = "post" action = "http://localhost/q15update.php">
    <label>Enter order ID to remove: </label>
    <input type = "text" name = "id" placeholder = "Order ID...">
    <input type = "submit">
</body>
</html>