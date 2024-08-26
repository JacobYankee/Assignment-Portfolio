<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
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

    //database query for orders
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q5");
    $query = "SELECT * FROM orders";
    $result = mysqli_query($db, $query);
    $numrows = mysqli_num_rows($result);

    //loop through orders, print orders that have same id
    print "<title>Orders Page</title>
    <h1>Orders Page</h1> <hr> <br>";
    print"<h2>Your Orders:</h2><table>
    <tr><th>Order ID</th><th>Item</th><th>Amount</th><th>Price</th><th>Shipping Status</th></tr>";
    $orderTotal = 0;
    for ($i = 0; $i < $numrows; $i++)
    {
        $row = mysqli_fetch_assoc($result);
        $aID = $row["AutoID"];
        $user = $row["userID"];
        $items = $row["numItems"];
        $ship = $row["shipStatus"];
        $price = $row["oPrice"];
        $item = $row["iID"];
        $name = $row["itemName"];

        if($id == $user)
        {
            print "<tr><td>$aID</td><td>$name</td><td>$items</td><td>$price</td><td>$ship</td></tr>";
        }
    }
    print "</table>";
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
</html>