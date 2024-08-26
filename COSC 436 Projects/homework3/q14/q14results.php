<!--Jacob Yankee
COSC 436
Maniccam
Homework 3-->
<!DOCTYPE html>
<html>
<head> 
    <title> Survey Site Results</title>
    <link rel = "stylesheet" href = "q14.css">
</head>
<body>
    <h1>Survey Site</h1>
    <?php
    //connect to database
        $db = mysqli_connect("127.0.0.1", "admin", "password1", "h3q14");
        //query to get values from password table
        $qPass = "SELECT * FROM passwords";
        $rPass = mysqli_query($db, $qPass);
        $nPass = mysqli_num_rows($rPass);
        //get value from the form
        if(isset($_POST["password"]))
            $user = $_POST["password"];
        $access = 0;
        //query to get data from survey table
        $qSurv = "SELECT * FROM survey";
        $rSurv = mysqli_query($db, $qSurv);
        $nSurv = mysqli_num_rows($rSurv);
        //outer loop password check
        for($i = 0; $i < $nPass; $i++)
        {
            $pRow = mysqli_fetch_assoc($rPass);
            $pas = $pRow["pwd"];
            if($user == $pas)
            {
                print"<table>";
                print"<tr>";
                print"<th>ID</th>";
                print"<th>Question</th>";
                print"<th>Yes</th>";
                print"<th>No</th>";
                print"</tr>";
                //prevents error message from appearing
                $access = 1;
                //inner loop prints all values in survey table
                for($j = 0; $j < $nSurv; $j++)
                {
                    $sRow = mysqli_fetch_assoc($rSurv);
                    $id = $sRow["id"];
                    $quest = $sRow["question"];
                    $yes = $sRow["yes"];
                    $no = $sRow["no"];
                    $yesP = ($yes / ($yes + $no) * 100);
                    $noP = ($no / ($yes + $no) * 100);
                    print"<tr>";
                    print"<td>$id</td>";
                    print "<td>$quest</td>";
                    print"<td>$yesP%</td>";
                    print"<td>$noP%</td>";
                    print"</tr>";
                }
            }

        }
        print"</table>";
        //error message that only appears when password is incorrect
        if($access == 0)
        print"<h1>Access denied: Incorrect password.</h1>";
    ?>
</body>
</html>