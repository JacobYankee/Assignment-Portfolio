<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<html>
<head>
    <title>Web Programming Exam</title>        
    <link rel = "stylesheet" href = "q3.css">
</head>

<body>
    <?php
    date_default_timezone_set("America/New_York");
    session_start();
    //get password from form
        $user = $_POST["code"];
        $access = 0;
        //connect to database
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q3");
        //query to get values from students table
        $qStu = "SELECT * FROM students";
        $rStu = mysqli_query($db, $qStu);
        $nStu = mysqli_num_rows($rStu);

        //query to get values from exam table
        $qExam = "SELECT * FROM exam";
        $rExam = mysqli_query($db, $qExam);
        $nExam = mysqli_num_rows($rExam);
        //outer loop to check password
        for($i = 0; $i < $nStu; $i++)
        {
            $sRow = mysqli_fetch_assoc($rStu);
            $code = $sRow["code"];
            $seen = $sRow["seen"];
            $comp = $sRow["complete"];
            //alter access value if user has completed or seen exam
            if ($user == $code && ($comp == 1 || $seen == 1))
            {
                $access = 2;
            }
            //create exam if user has not completed or seen exam
            if ($user == $code && $comp == 0 && $seen == 0)
            {
                //put password in session array
                $_SESSION["passcode"] = $user;
                //query to update student's seen status
                $upSeen = "UPDATE `students` SET `seen` = '1' WHERE `code` = '$user'";
                $seenChange = mysqli_query($db, $upSeen);

                //get time, save to session
                $startTime = date("h:i:s a");
                $_SESSION["startTime"] = $startTime;

                print "<h1>Begin exam. Do not close or refresh this page.</h1>";
                print"<h2>Exam start time: $startTime</h2>";
                print "<h3>Exam time limit: $nExam minutes</h3>";
                print "<table>";
                print "<tr><th>Question</th><th>Answer 1</th><th>Answer 2</th><th>Answer 3</th><th>Answer 4</th>";
                //form to take exam
                print"<form method = \"post\" action = \"http://localhost/q3grade.php\">";
                //inner loop to create exam
                for($j = 0; $j < $nExam; $j++)
                {
                    $eRow = mysqli_fetch_assoc($rExam);
                    $q = $eRow["question"];
                    $a1 = $eRow["answer1"];
                    $a2 = $eRow["answer2"];
                    $a3 = $eRow["answer3"];
                    $a4 = $eRow["answer4"];
                    print "<tr>";
                    print "<td>$q</td>";
                    print "<td><input type = \"radio\" name = \"q$j\" value = \"1\">$a1</input></td>";
                    print "<td><input type = \"radio\" name = \"q$j\" value = \"2\">$a2</input></td>";
                    print "<td><input type = \"radio\" name = \"q$j\" value = \"3\">$a3</input></td>";
                    print "<td><input type = \"radio\" name = \"q$j\" value = \"4\">$a4</input></td>";
                    print "</tr>";
                }
                print "</table>";
                print "<input type = \"submit\">";
                print "</form>";
                //alter access value to prevent error messages
                $access = 1;
            }
        }
        //error message for completed exam
        if ($access == 2)
        print "<h1> Access denied: User has already completed exam.</h1>";
    //error message for invalid user
    if ($access == 0)
        print "<h1> Access denied: Invalid user.</h1>";

    ?>
</body>
</html>