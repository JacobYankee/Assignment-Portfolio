<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!--survey.php - form has questions, radio groups, text box, submit
           - form must be created dynamically

           - select all questions from survey
           - put questions in form
           - answers are in radio group
           - radio group of each question must have a name, create it dynamically

           - calls update.php-->
<html>
<head> 
    <title> Survey Site</title>
    <link rel = "stylesheet" href = "q14.css">
</head>
<body>
    <h1>Survey Site</h1>
    <?php
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h3q14");

        $query = "SELECT * FROM survey";

        $result = mysqli_query($db, $query);

        $num_rows = mysqli_num_rows($result);
        print"<form method = \"post\" action = \"http://localhost/q14update.php\">";
        print "<table>";
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
    <a href = "q14results.html">View Results</a>
</body>
</html>