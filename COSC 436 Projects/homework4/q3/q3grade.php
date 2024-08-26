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
    session_start();
    date_default_timezone_set("America/New_York");
    //get password value from form
        $user = $_SESSION["passcode"];
        $startTime = $_SESSION["startTime"];
        $endTime = date("h:i:s a");
        //split times, loop through using regex to get time as flat numbers (09:40:22 -> 094022)
        $sTime = str_split($startTime);
        $start = "";
        foreach($sTime as $q)
        {
            if (preg_match('/\d/', $q) == 1)
            $start = "$start$q";
        }
        $eTime = str_split($endTime);
        $end = "";
        foreach($eTime as $w)
        {
            if (preg_match('/\d/', $w) == 1)
            $end = "$end$w";
        }
        $timeTaken = $end - $start;
        $access = 0;
        $score = 0;
        //connect to database
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q3");
        //query to get values from student table
        $qStu = "SELECT * FROM students";
        $rStu = mysqli_query($db, $qStu);
        $nStu = mysqli_num_rows($rStu);

        //query to get values from exam table
        $qExam = "SELECT * FROM exam";
        $rExam = mysqli_query($db, $qExam);
        $nExam = mysqli_num_rows($rExam);
        //outer loop for passcode check
        for($i = 0; $i < $nStu; $i++)
        {
            $sRow = mysqli_fetch_assoc($rStu);
            $code = $sRow["code"];
            $comp = $sRow["complete"];
            //check for students that took too long to complete the exam
            if($user == $code && $timeTaken > ($nExam * 100))
            {
                $access = 2;
            }
            //check for students that have not completed exam
            if($user == $code && $comp == 0 && $timeTaken <= ($nExam * 100))
            {
                $access = 1;
                //inner loop to compare submitted answers with correct ones
                for($j = 0; $j <$nExam; $j++)
                {
                    $eRow = mysqli_fetch_assoc($rExam);
                    if(isset($_POST["q$j"]) == 1)
                        $ans = $_POST["q$j"];
                    else
                        $ans = "null";
                    $right = $eRow["correct"];
                    if ($ans == $right)
                    {
                    $score = $score + 1;
                    }
                }
            }
        }
        //Time limit exceeded message
        if ($access == 2)
        {
            print "<h1>Time limit exceeded.</h1>";
            print "<h1>Exam score: 0 out of $nExam</h1>";
            $timeScore = "UPDATE `students` SET `complete` = '1', `score` = '0' WHERE `code` = '$user'";
            $scTime = mysqli_query($db, $timeScore);
        }
        //score message that updates students table with score
        if ($access == 1)
        {
            print "<h1> Exam score: $score out of $nExam</h1>";
            /*print "<h2>Start time: $startTime</h2>";
            print "<h2>End time: $endTime</h2>";
            print "<h2>Time taken: $timeTaken</h2>";*/
            $upScore = "UPDATE `students` SET `complete` = '1', `score` = '$score' WHERE `code` = '$user'";
            $scChange = mysqli_query($db, $upScore);
        }
    ?>
</body>
</html>