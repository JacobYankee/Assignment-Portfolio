<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html>
<head> 
   <title>Message Board</title>
   <style>
    body{
      font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
      background-color:azure;
   }
  h1{
    text-align: center;
    }
  table, td{
      width: 100%; 
      border-style: solid; border-color: dodgerblue; border-width: 2px; 
      border-collapse: collapse;
      padding: 8px;
    }
  tr:hover {background-color: snow;}
</style>
</head>

<body>
   <h1> Message board </h1>

   <table>

   <?php
   //connect to database
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h3q13");
        //get message from the form
        $message = $_POST["message"];
        //get timestamp
        date_default_timezone_set("America/New_York");
        $date = date("m/d/Y h:i:sa");
        //query to post new message
        $query = "INSERT INTO message_board(date, message) VALUES('$date', '$message')";

        $result = mysqli_query($db, $query);
        //query to get values in message_board
        $query1 = "SELECT * FROM message_board";

        $result1 = mysqli_query($db, $query1);

        $num_rows = mysqli_num_rows($result1);
        //print contents of table
        print "<table>";
        for ($i = 0; $i < $num_rows; $i++)
        {
            $row = mysqli_fetch_assoc($result1);

            $date = $row["date"];
            $message = $row["message"];

            print "<tr><td>";
            print "$message<br>";
            print "$date";
            print "</td></tr>";
        }
        print "</table>";
   ?>

   </table>
   <br>
   <!--form to get new message-->
   <form method="post" action="http://localhost/q13update.php">
      <input type="text" size="100" maxlength="100" name="message" placeholder="Type message here..."></input>
      <input type="submit" value="Post Message"></input>
   </form>
   
   </body>
</html>


