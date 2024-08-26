<!DOCTYPE html>
<html>
    <head>
        <title>Update</title>
        <style>
            body{
                text-align:center;
                background-color: tomato;
                color: white;
                font-family: Tahoma, sans-serif;
            }
            hr{
				height:2px;
				border-width:0;
				color:black;
				background-color:orangered;
				}
            img:hover{
                width: 16%;
            }
        </style>
</head>
<body>
<a href = "mainpage.php"><img src = "https://cdn.discordapp.com/attachments/1180984530451038319/1180984602895077476/Logo.png?ex=657f689e&is=656cf39e&hm=6fcfaf4c74fc340f51a6b0eb15a2632e820cf1c52e15f20cb64dd6207d2db4d0&" width = "15%"></a>
        <br>
        <p>Click above to return to the home page</p>
        <hr>
    <?php
    error_reporting(E_ALL& ~E_DEPRECATED);
    ini_set('display_errors', 'On');
    
    $name = $_POST["name"];
    $price = $_POST["price"];
    $short = $_POST["short"];
    $long = $_POST["long"];
    $img = $_POST["img"];

    $db = mysqli_connect("cosc473project.coend9cuqsan.us-east-1.rds.amazonaws.com", "admin", "cosc473password", "projectSchema");

    $query = "SELECT * FROM storeItems";
    $result = mysqli_query($db, $query);
    $numrows = mysqli_num_rows($result);
        
    $itemID = $numrows + 1;
    print "<h1>Upload success!</h1>";
    print "<br>";
    print "<p> The newly created page can be found <a href = \"itempage.php?id=$itemID\"><button>here</button></a></p>";
    $query1 = "INSERT INTO storeItems (id, itemName, price, shortDesc, longDesc, imgLink) VALUES ($itemID, '$name', $price, '$short', '$long', '$img')";
    $update = mysqli_query($db, $query1);
    ?>
</body>
</html>