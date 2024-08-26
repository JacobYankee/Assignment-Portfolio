<?php
/*Jacob Yankee
COSC 436
Homework 3
Maniccam*/

//Question 1, factors of a number
function factors($x)
{
    $temp = "";
    if ($x < 0)
    $temp = "invalid";
    else
    {
        //check every number i between 1 and x, if x is divisible by i add i to output string
        for($i = 1; $i < $x; $i++)
        {
            if ($x % $i == 0)
            $temp = "$temp$i, ";
        }
        $temp = "$temp$x";
    }
    return $temp;
}

$a1 = factors(12);
echo "qestion 1: $a1";
echo "\n";
$a2 = factors(-12);
echo "qestion 1: $a2";
echo "\n";

//question 2, tax calculation
function tax($x, $y)
{
    $z = 0;
    //get input in lower case
    $y = strtolower($y);  
    //set of nested conditionals to determine tax
    if($y == "single")
    {
        if( $x < 30000)
        $z = $x * 0.2;
        if($x >= 30000)
        $z = $x * 0.25;
    }
    if($y == "married")
    {
        if($x < 50000)
        $z = $x * 0.1;
        if($x >= 50000)
        $z = $x * 0.15;
    }
    return $z;
}

$b1 = tax(25000, "single");
$b2 = tax(35000, "SINGLE");
$b3 = tax(35000, "MARRIED");
$b4 = tax(55000, "married");
echo "Question 2: $b1";
echo "\n";
echo "Question 2: $b2";
echo "\n";
echo "Question 2: $b3";
echo "\n";
echo "Question 2: $b4";
echo "\n";

//Question 3, standard deviation
function stdDev($x)
{
    $sum = 0;
    if(count($x) < 2)
    return 0;
    else
    {
        //find sum
        foreach($x as $element)
            $sum = $sum + $element;
        $mean = $sum / count($x);

        //find summation
        $stdDev = 0;
        foreach($x as $elements)
        $stdDev += pow(($elements - $mean), 2);

        //find standard deviation
        $ret = $stdDev / count($x);
        $ret = sqrt($ret);
        return $ret;
    }
}
$c1 = array(1, 2, 3, 4);
$c2 = stdDev($c1);
echo "Question 3: $c2";
echo "\n";

//Question 4, compound interest
function compoundInterest($p, $r, $n)
{
    //compute compound interest formula
    return $p * pow((1+ $r / 100), $n);
}
$d1 = compoundInterest(1000, 20, 10);
echo "Question 4: $d1";
echo "\n";

//Question 5, ID and password creation
function createIdPassword($first, $last)
{
    //get string lengths
    $flen = strlen($first);
    $llen = strlen($last);
    //get certain characters in strings
    $flast = $flen -1;
    $first = strtoupper($first);
    $last = strtoupper($last);
    $f1 = substr($first, 0, 1);
    $f2 = substr($first,$flast, 1);
    $l1 = substr($last, 0, 3);
    //create id and password
    $id = "$f1$last";
    $password = "$f1$f2$l1$flen$llen";
    $arr = array("id" => $id,
                 "password" => $password);
    foreach($arr as $key => $value)
    {
        print "key is $key ";
        print "value is $value \n";
    }
}
echo "Question 5:\n";
$e1 = createIdPassword("John","Maxwell");

//Question 6, remove duplicates from an array
function removeDuplicates($x)
{
    $noDupes = [];
    
    //loop to compare values in initial array and values stored in array
    foreach($x as $str)
    $noDupes[$str] = $str;

    //loop to print array
    foreach($noDupes as $elements)
    echo "$elements ";
}
echo "Question 6: \n";
$f1 = array("tree", "cat", "box", "cat", "dog", "tree", "tree");
$f2 = removeDuplicates($f1);
echo "\n";

//Question 7, Student class with getName, getGpa, setName, setGpa, and isHonors methods
class Student
{
    private $name;
    private $gpa;
    //class constructor
    public function __construct($name, $gpa)
    {
        $this->name = $name;
        $this->gpa = $gpa;
    }
    //setter functions
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setGpa($gpa)
    {
        $this->gpa = $gpa;
    }
    //getter functions
    public function getName()
    {
        return $this->name;
    }
    public function getGpa()
    {
        return $this->gpa;
    }
    //conditional function to determine honors status
    public function isHonors()
    {
        if( $this->gpa >= 3)
        return "true";

        else
        return "false";
    }
}
echo "Question 7: \n";
$g1 = new Student("kevin", 3.7);
echo $g1->getName();
echo "\n";
echo $g1->getGpa();
echo "\n";
echo $g1->isHonors();
echo "\n";

//question 8, university and phone functions using regex
function university($id)
{
    //regex conditional to check ID
    if(preg_match("/^E-0\d{2}[a-z]{1}-9[a-z]{2}\d{1}/", $id) == 1)
    return "true";
    else
    return "false";
}
function phone($phone)
{
    //regex conditional to check phone number
    if(preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone) == 1)
    return "true";
    else
    return "false";
}
echo "Question 8: \n";
$h1 = university("E-085s-9ds1");
echo $h1;
echo "\n";
$h2 = phone("123-456-7890");
echo $h2;
echo "\n";
$h3 = phone("E-085s-9ds1");
echo $h3;
echo "\n";
$h4 = university("123-456-7890");
echo $h4;
?>