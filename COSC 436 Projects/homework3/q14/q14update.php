<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html>
<head> 
    <title>Survey Site</title>
    <link rel = "stylesheet" href = "q14.css">
</head>
<body>
    <?php
    //connect to database
    $db = mysqli_connect("127.0.0.1", "admin", "password1", "h3q14");
    //get passcode value from form
    $pass = $_POST["passcode"];
    $inDb = 0;
    //query to get values from passcode table
    $q1 = "SELECT * FROM passcode";
    $r1 = mysqli_query($db, $q1);
    $n1 = mysqli_num_rows($r1);

    //query to get values from survey table
    $q2 = "SELECT * FROM survey";
    $r2 = mysqli_query($db, $q2);
    $n2 = mysqli_num_rows($r2);
    //outer loop passcode check
    for($i = 0; $i <$n1; $i++)
    {
        $row1 = mysqli_fetch_assoc($r1);
        $code = $row1["code"];
        $comp = $row1["complete"];
        //conditional to determine if user has taken survey
        if($pass == $code && $comp == 0)
        {
            //update passcode table
            $qUp = "UPDATE passcode SET `complete` = '1' WHERE `code` = '$pass'";
            $rUp = mysqli_query($db, $qUp);
            //set inDb to 1 to prevent error message from popping up
            $inDb = 1;
            //update survey results
            for($j= 0; $j < $n2; $j++)
            {
                $row2 = mysqli_fetch_assoc($r2);
                $id = $row2["id"];
                $yes = $row2["yes"];
                $no = $row2["no"];
                
                if (isset($_POST["id$j"]))
                    $yesNo = $_POST["id$j"];
                else
                    $yesNo = "nil";
                if ($yesNo == "yes")
                {
                    $yes = $yes + 1;
                    $qSyes = "UPDATE survey SET `yes` = '$yes' WHERE `id` = '$id'";
                    $rSyes = mysqli_query($db, $qSyes);
                }
                if ($yesNo == "no")
                {
                    $no = $no + 1;
                    $qSno = "UPDATE survey SET `no` = '$no' WHERE `id` = '$id'";
                    $rSno = mysqli_query($db, $qSno);
                }
            }
            print"<h1>Results have been submitted</h1>";
            break;
        }
        //check if user has already done survey
        if($pass == $code && $comp != 0)
        {
            print"<h1>Survey already submitted</h1>";
            //set inDb to 1 to prevent error message from popping up
            $inDb = 1;
            break; 
        }
    }
    //error message if user is not found
    if($inDb == 0)
        print"<h1>Error: User not found.</h1>";
    ?>
</body>
</html>