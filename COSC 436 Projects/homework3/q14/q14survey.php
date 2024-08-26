<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html>
<head> 
    <title> Survey Site</title>
    <link rel = "stylesheet" href = "q14.css">
</head>
<body>
    <h1>Survey Site</h1>
    <?php
    //connect to database
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h3q14");
        //query to get values from survey table
        $query = "SELECT * FROM survey";

        $result = mysqli_query($db, $query);

        $num_rows = mysqli_num_rows($result);
        //form to get user input
        print"<form method = \"post\" action = \"http://localhost/q14update.php\">";
        print "<table>";
        //loop to create survey using values from database
        for ($i = 0; $i < $num_rows; $i++)
        {
            $row = mysqli_fetch_assoc($result);

            $question = $row["question"];
            print "<tr>";
            print "<td><label>$question</label></td>";
            print "<td><input type = \"radio\" name = \"id$i\" value = \"yes\">Yes</input></td>";
            print "<td><input type = \"radio\" name = \"id$i\" value = \"no\">No</input></td>";
            print"</tr>";
        }
        print "</table>";
        print "<input type = \"text\" name = \"passcode\" placeholder = \"Enter passcode\"></input>";
        print "<input type = \"submit\">";
        print "</form>";
    ?>
    <!--anchor tag to access results page-->
    <a href = "q14results.html">View Results</a>
</body>
</html>