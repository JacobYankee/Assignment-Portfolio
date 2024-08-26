<!--Jacob Yankee
COSC 436
Maniccam
Homework 4-->
<!DOCTYPE html>
<html>
    <head>
    <title>Web Programming Exam Instructor Portal</title>
        <link rel = "stylesheet" href = "q3.css">
</head>
<body>
    <?php
    //connect to database
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h4q3");

    //query to get values from passwords table
    $qPass = "SELECT * FROM passwords";
    $rPass = mysqli_query($db, $qPass);
    $nPass = mysqli_num_rows($rPass);
    $user = $_POST["password"];
    $access = 0;

    //query to get values from students table
    $qStu = "SELECT * FROM students";
    $rStu = mysqli_query($db, $qStu);
    $nStu = mysqli_num_rows($rStu);
    //outer loop for password check
    for($i = 0; $i < $nPass; $i++)
        {
            $pRow = mysqli_fetch_assoc($rPass);
            $pas = $pRow["pwd"];
            //conditional for password check and access alteration
            if($user == $pas)
            {
                $access = 1;
                print "<h1>Exam results</h1>";
                print"<table>";
                print"<tr><th>Name</th><th>Passcode</th><th>Status</th><th>Score</th></tr>";
                //inner loop to print students table values in an html table
                for($j = 0; $j < $nStu; $j++)
                {
                    $sRow = mysqli_fetch_assoc($rStu);
                    $name = $sRow["sName"];
                    $code = $sRow["code"];
                    $seen = $sRow["seen"];
                    $comp = $sRow["complete"];
                    $score = $sRow["score"];
                    if ($seen == 1 && $comp == 1)
                    {
                        $status = "Complete";
                    }
                    else if ($seen == 1 && $comp == 0)
                    {
                        $status = "Incomplete";
                    }
                    else if ($seen == 0 && $comp == 0)
                    {
                        $status = "Not taken";
                    }
                    print"<tr><td>$name</td><td>$code</td><td>$status</td><td>$score</td></tr>";
                }
                print "</table>";
            }
        }
        //access denied error message
    if ($access == 0)
        print "<h1>Access denied. Incorrect password.</h1>";
    ?>
</body>
</html>