<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<?php
    //kill off any existing sessions
    session_start();
    session_destroy();

    //connect to database, query all tables
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q5");
    $qUsers = "SELECT * FROM users";
    $rUsers = mysqli_query($db, $qUsers);
    $nUsers = mysqli_num_rows($rUsers);
    $qItems = "SELECT * FROM items";
    $rItems = mysqli_query($db, $qItems);
    $nItems = mysqli_num_rows($rItems);
    $qOrders = "SELECT * FROM orders";
    $rOrders = mysqli_query($db, $qOrders);
    $nOrders = mysqli_num_rows($rOrders);
    $qEmployee = "SELECT * FROM employee";
    $rEmployee = mysqli_query($db, $qEmployee);
    $nEmployee = mysqli_num_rows($rEmployee);

    //When the page is first loaded
    if(!isset($_POST["passcode"]))
    {   print "<title>Employee Action Page</title><h1>Employee Access</h1><hr><br>";
        print "<h2>Select an action, enter the passcode, and submit.</h2>";
        print "<form method = \"post\" action = \"http://localhost/q5access.php\">
            <input type = \"radio\" name = \"action\" value =\"1\"><label>Display All Users</label><br>
            <input type = \"radio\" name = \"action\" value =\"2\"><label>Display All Items</label><br>
            <input type = \"radio\" name = \"action\" value =\"3\"><label>Display All Orders</label><br>
            <input type = \"radio\" name = \"action\" value =\"4\"><label>Display Not Shipped Orders</label><br>
            <input type = \"radio\" name = \"action\" value =\"5\"><label>Ship An Order: </label><input type = \"text\" name = \"order\" placeholder = \"Order ID\"><br>
            <input type = \"radio\" name = \"action\" value =\"6\"><label>Add An Item: </label><input type = \"text\" name = \"addID\" placeholder = \"Item ID\"> <input type = \"text\" name = \"addName\" placeholder = \"Name\"> <input type = \"text\" name = \"addPrice\" placeholder = \"Price\"> <br>
            <input type = \"radio\" name = \"action\" value =\"7\"><label>Remove An Item: </label><input type = \"text\" name = \"delete\" placeholder = \"Item ID\"><br>
            <label>Enter Passcode</label><input type = \"text\" name = \"passcode\" placeholder = \"Passcode\">
            <input type = \"submit\">
            </form>";
    }
    //access variable
    $access = 0;
    //When an action is selected and the passcode is entered
    if (isset($_POST["passcode"]))
    {
        $code = $_POST["passcode"];
        //confirm passcode is correct
        for($i = 0; $i < $nEmployee; $i++)
        {
            $rowEmp = mysqli_fetch_assoc($rEmployee);
            $pwd = $rowEmp["passcode"];
            if($code == $pwd)
            $access = 1;
        }
    }
    //run actions
    if (isset($code) && $access == 1)
    {
        //Use conditionals for every action
        if(isset($_POST["action"]))
        {
            $act = $_POST["action"];
        }
        //display all users
        if ($act == 1)
        {
            print "<h1>Action success</h1>";
            print"<table><tr><th>ID</th><th>Password</th><th>Name</th><th>Address</th><th>Card</th></tr>";
            for($i = 0; $i < $nUsers; $i++)
            {
                $rowUse = mysqli_fetch_assoc($rUsers);
                $id = $rowUse["id"];
                $upwd = $rowUse["uPwd"];
                $uname = $rowUse["uName"];
                $uaddress = $rowUse["uAddress"];
                $ucard = $rowUse["uCard"];
                print "<tr><td>$id</td><td>$upwd</td><td>$uname</td><td>$uaddress</td><td>$ucard</td></tr>";
            }
            print "</table>";
        }
        //display all items
        if ($act == 2)
        {
            print "<h1>Action success</h1>";
            print"<table><tr><th>Item ID</th><th>Item Name</th><th>Price</th></tr>";
            for($i = 0; $i < $nItems; $i++)
            {
                $rowItem = mysqli_fetch_assoc($rItems);
                $iid = $rowItem["iID"];
                $iname = $rowItem["iName"];
                $iprice = $rowItem["iPrice"];
                print "<tr><td>$iid</td><td>$iname</td><td>$iprice</td></tr>";
            }
            print "</table>";
        }
        //display all orders
        if ($act == 3)
        {
            print "<h1>Action success</h1>";
            print"<table><tr><th>Order ID</th><th>User ID</th><th>Item Name</th><th>Item ID</th><th>Number Of Items</th><th>Shipping Status</th><th>Price</th></tr>";
            for($i = 0; $i < $nOrders; $i++)
            {
                $rowOrd = mysqli_fetch_assoc($rOrders);
                $autoid = $rowOrd["AutoID"];
                $userid = $rowOrd["userID"];
                $itemname = $rowOrd["itemName"];
                $iid = $rowOrd["iID"];
                $numitems = $rowOrd["numItems"];
                $shipstatus = $rowOrd["shipStatus"];
                $oprice = $rowOrd["oPrice"];
                print "<tr><td>$autoid</td><td>$userid</td><td>$itemname</td><td>$iid</td><td>$numitems</td><td>$shipstatus</td><td>\$$oprice</td></tr>";
            }
            print "</table>";
        }
        //display orders not shipped
        if ($act == 4)
        {
            print "<h1>Action success</h1>";
            print "<table><tr><th>Order ID</th><th>Item Name</th><th>Number Of Items</th><th>Price</th><th>User Name</th><th>Address</th><th>Card</th></tr>";
            //get rows from result of users query, store in array
            $userRows = array();
            while ($rowUse = mysqli_fetch_assoc($rUsers)) 
            {
                $userRows[] = $rowUse;
            }
            //get rows from result of orders query, store in array
            $orderRows = array();
            while ($rowOrd = mysqli_fetch_assoc($rOrders)) 
            {
                $orderRows[] = $rowOrd;
            }
            //get values from users array
            foreach ($userRows as $userRow) 
            {
            $id = $userRow["id"];
            $uname = $userRow["uName"];
            $uaddress = $userRow["uAddress"];
            $ucard = $userRow["uCard"];
            //get values from orders array
            foreach ($orderRows as $orderRow) 
                {
                $autoid = $orderRow["AutoID"];
                $userid = $orderRow["userID"];
                $itemname = $orderRow["itemName"];
                $numitems = $orderRow["numItems"];
                $oprice = $orderRow["oPrice"];
                $shipstatus = $orderRow["shipStatus"];
                if (strlen($shipstatus) > 7 && $userid == $id) 
                    {
                    print "<tr><td>$autoid</td><td>$itemname</td><td>$numitems</td><td>$oprice</td><td>$uname</td><td>$uaddress</td><td>$ucard</td></tr>";
                    }
                }
            }
        print "</table>";
        }
        if ($act == 5)
        {
            //error check variable
            $shipped = 0;
            if (isset($_POST["order"]))
            {
            $shipMe = $_POST["order"];
            for($i = 0; $i < $nOrders; $i++)
                {
                    $rowOrd = mysqli_fetch_assoc($rOrders);
                    $autoid = $rowOrd["AutoID"];
                    if ($shipMe == $autoid)
                    {
                        print "<h1>Action success</h1>";
                        $ship = "UPDATE orders SET `shipStatus` = 'Shipped' WHERE `AutoID` = '$shipMe'";
                        $shipOut = mysqli_query($db, $ship);
                        $shipped = 1;
                    }
                }
            }
            if ($shipped == 0)
            print "<h1>Action failed. Invalid Order ID.</h1>";
        }
        if ($act == 6)
        {
            $added = 0;
            if (isset($_POST["addName"]) && isset($_POST["addID"]) && isset($_POST["addPrice"]))
            {
                $adna = $_POST["addName"];
                $adid = $_POST["addID"];
                $adpr = $_POST["addPrice"];
                //make sure id isnt in table already
                for($i = 0; $i < $nItems; $i++)
                {
                $rowItem = mysqli_fetch_assoc($rItems);
                $iid = $rowItem["iID"];
                    if ($adid == $iid)
                    {
                    $added = 2;
                    }
                }
                if ($added !=2)
                {
                    print "<h1>Action success</h1>";
                $addMe = "INSERT INTO items (iID, iName, iPrice) VALUES ('$adid', '$adna', '$adpr')";
                $addNow = mysqli_query($db, $addMe);
                $added = 1;
                }
            }
            if ($added == 2)
            print "<h1>Error: Item with ID already exists</h1>";
            if ($added == 0)
            print "<h1>Action failed. Invalid Input</h1>";

        }
        if ($act == 7)
        {
            $deleted = 0;
            if (isset($_POST["delete"]))
            {
            $del = $_POST["delete"];
                for($i = 0; $i < $nItems; $i++)
                {
                $rowItem = mysqli_fetch_assoc($rItems);
                $iid = $rowItem["iID"];
                    if ($del == $iid)
                    {
                        print "<h1>Action success</h1>";
                        $deleted = 1;
                        $deleteMe = "DELETE FROM items WHERE iID = '$del'";
                        $deleteNow = mysqli_query($db, $deleteMe);
                    }
                }
            }
            if ($deleted == 0)
            {
                print "<h1>Action failed. Invalid input</h1>";
            }

        }
        print "<a href = \"http://localhost/q5access.php\"><button>Return</button></a>";
    }
    
    if (isset($code) && $access == 0)
    {
        print"<h1>Error: Incorrect password. Access denied.</h1>";
    }
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