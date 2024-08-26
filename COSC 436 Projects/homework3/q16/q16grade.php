<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html>
<head>
    <title>Web Programming Exam</title>        
    <link rel = "stylesheet" href = "q16.css">
</head>

<body>
    <?php
    //get password value from form
        $user = $_POST["code"];
        $access = 0;
        $score = 0;
        //connect to database
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h3q16");
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
            //check for students that have completed the exam
            if($user == $code && $comp == 1)
            {
                $access = 2;
            }
            //check for students that have not completed exam
            if($user == $code && $comp == 0)
            {
                $access = 1;
                //inner loop to compare submitted answers with correct ones
                for($j = 0; $j <$nExam; $j++)
                {
                    $k = $j+1;   
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
        //invalid user error message
        if ($access == 0)
        {
            print "<h1>Error: Invalid user.</h1>";
        }
        //exam completed error message
        if ($access == 2)
        {
            print "<h1>Error: User has already taken exam.</h1>";
        }
        //score message that updates students table with score
        if ($access == 1)
        {
            print "<h1> Exam score: $score out of $k</h1>";
            $upScore = "UPDATE `students` SET `complete` = '1', `score` = '$score' WHERE `code` = '$user'";
            $scChange = mysqli_query($db, $upScore);
        }
    ?>
</body>
</html>