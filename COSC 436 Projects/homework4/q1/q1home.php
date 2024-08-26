<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<html>

<head>
    <title>Restaruant Order Form</title>
    <link rel = "stylesheet" href = "q1.css">
</head>
<body>
    <h1>Restaruant Order Form</h1>
    <!--form to get values for order-->
    <form method = "post" action = "http://localhost/q1customer.php">
        <label>Pizza:</label>
        <input type = "checkbox" name = "pizza">$7.99 &nbsp;</input>
        <label>Burger:</label>
        <input type = "checkbox" name = "burger">$5.99 &nbsp;</input>
        <label>Soda:</label>
        <input type = "checkbox" name = "soda">$0.99 &nbsp;</input>
        <br>
        <table>
        <tr><td><label>Customer Name</label></td>
        <?php
        if (!isset($_COOKIE["name"]))
        {
            print "<td><input type = \"text\" name = \"name\" maxlength=\"30\"></td></tr>";
        }
        else
        {
            $name = $_COOKIE["name"];
            print "<td><input type \"text\" value = \"$name\" name = \"name\" maxlengh = \"30\"></td></tr>";
        }
        print "<tr><td><label>Address</label></td>";
        if (!isset($_COOKIE["address"]))
        {
            print "<td><input type = \"text\" name = \"address\" maxlength=\"100\"></td></tr>";
        }
        else
        {
            $address = $_COOKIE["address"];
            print "<td><input type \"text\" value = \"$address\" name = \"address\" maxlengh = \"100\"></td></tr>";
        }
        ?>
        <tr><td><label>Credit Card</label></td>
        <td><input type = "text" name = "card" maxlength="20"></td></tr>
        </table>
        <br>
        <input type = "submit">
        <input type = "reset">
    </form>
</body>
</html>