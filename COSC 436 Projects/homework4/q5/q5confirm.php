<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<?php
    //configure session values
    session_start();
if (isset($_SESSION["id"]))
{
    $id = $_SESSION["id"];
}
if (isset($_SESSION["pwd"]))
{
    $pwd = $_SESSION["pwd"];
}

    //database query
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q5");
    $query = "SELECT * FROM items";
    $result = mysqli_query($db, $query);
    $numrows = mysqli_num_rows($result);

    //create orders from shop form
    print "<title>Orders Confirmed</title>";
    print"<h2>Orders made:</h2><table>
    <tr><th>Order ID</th><th>Item</th><th>Amount</th><th>Price</th><th>Total</th></tr>";
    $orderTotal = 0;
    for ($i = 0; $i < $numrows; $i++)
    {
        $row = mysqli_fetch_assoc($result);
        $item = $row["iID"];
        $name = $row["iName"];
        $price = $row["iPrice"];

        if(isset($_POST["check$i"]) && isset($_POST["amt$i"]))
        {
            $amt = $_POST["amt$i"];
            $sum = $amt * $price;
            $orderID = rand(1, 100000);
            print "<tr><td>$orderID</td><td>$name</td><td>$amt</td><td>\$$price</td><td>\$$sum</td>";
            $orderTotal += $sum;
            $orderQuery = "INSERT INTO orders (AutoID, userID, itemName, iID, numItems, shipStatus, oPrice) VALUES ('$orderID', '$id', '$name', '$item', '$amt','Not Shipped', '$sum')";
            $ordersUpdate = mysqli_query($db, $orderQuery);
        }
    }
    print"</table><h3>Order total: \$$orderTotal</h3>";
    print"<a href = http://localhost/q5home.php><button>Home</button></a>
    <a href = http://localhost/q5login.php><button>Logout</button></a>";
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