<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<?php
//get name and address for cookies
$address = $_POST["address"];
$name = $_POST["name"];

//set cookies for name and address
setcookie("name", $name, time()+ 30 * 24 * 3600);
setcookie("address", $address, time() + 30 * 24 * 3600);
?>
<html>

<head>
    <title>Restaruant Order Form</title>
    <link rel = "stylesheet" href = "q1.css">
</head>
<body>
    <?php
    //get values from form, update bill depending on values
    $bill = 0;
    if(isset($_POST["burger"]))
    {
        $burger = 1;
        $bill += 5.99;
    }
    else
        $burger = 0;

    if(isset($_POST["pizza"]))
    {
        $pizza = 1;
        $bill += 7.99;
    }
    else
        $pizza = 0;
    if(isset($_POST["soda"]))
    {
        $soda = 1;
        $bill += 0.99;
    }
    else
        $soda = 0;
    
    $card = $_POST["card"];
    //unsure how autoID is supposed to be generated.
    //I first thought of using the row length of the database but that would cause issues if new orders were being made while orders were being taken care of
    //Don't want to create multiple orders with the autoID of 2 because there's constantly two orders in the table!
    $autoID = rand(0, 1000);
    //check if order is valid, user strlen to determine if text inputs are empty
    if(strlen($name) == 0)
        print "<h1>Error: Name not entered. Order invalid.</h1>";
    if(strlen($address) == 0)
        print "<h1>Error: Address not entered. Order invalid.</h1>";
    if(strlen($card) == 0)
        print "<h1>Error: Credit Card not entered. Order invalid.</h1>";
    if($pizza == 0 && $burger == 0 && $soda == 0)
        print "<h1>Error: No items entered. Order invalid.</h1>";
    else if (strlen($name) != 0 && strlen($address) != 0 && strlen($card) != 0 && ($pizza != 0 || $burger != 0 || $soda != 0))
    {
        //connect to database
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q1");
        //query to update database
        $query = "INSERT INTO orders (autoID, customer, payment, locale, burger, pizza, soda) VALUES ($autoID, '$name', '$card', '$address', $burger, $pizza, $soda)";
        $result = mysqli_query($db, $query);
        //print order summary in table
        print "<h1>Order Summary:</h1>";
        print"<table>";
        print"<tr><th>Order ID</th><th>Name</th><th>Address</th><th>Payment Info</th><th>Burger</th><th>Pizza</th><th>Soda</th>";
        print "<tr><td>$autoID</td><td>$name</td><td>$address</td><td>$card</td><td>$burger</td><td>$pizza</td><td>$soda</td></tr>";
        print "</table>";
        print "<h1>Total: \$$bill";
    }
    ?>
</body>

</html>