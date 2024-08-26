/*Jacob Yankee
COSC 436
Homework 2
Maniccam*/

//Question 1, middle value
function middle(x, y, z)
{
   if (y < x < z || z < x < y)
   {
    return x;
   }
   if (x < y < z || z < y < x)
   {
    return y;
   }
   if (x < z < y || y < z < x)
   {
    return z;
   }
}

console.log("Question 1+ "+middle(2, 1, 3));

//Question 2, factors
function factor(x)
{
    let str = "";
    for(let i = 1; i <= x; i++)
    {
        if (x % i ==0)
        str += i+", ";
    }
    return str;   
}

console.log("Question 2+ "+factor(100));

//Question 3, tax
function tax(x, str)
{
    let y = 0;
    
    if (str=="single")
    {
       if (x < 30000)
       {
        y = x * 0.2; 
       }
       if (x >= 30000)
       {
        y = x * 0.25;
       }
    }

    if (str=="married")
    {
        if (x < 50000)
       {
        y = x * 0.1; 
       }
       if (x >= 50000)
       {
        y = x * 0.15;
       }
    }

    let ret = "Tax owned: "+y;
    return ret;
}

console.log("Question 3: "+tax(25000, "single"));
console.log("Question 3: "+tax(35000, "single"));
console.log("Question 3: "+tax(35000, "married"));
console.log("Question 3: "+tax(55000, "married"));

//Question 4, standard deviation of a population with variable parameters
function stdDev()
{
    let sum = 0;

    if (arguments.length < 2)
    {
    return 0;
    }
else
    {
        //find sum of array
        for( var i = 0; i < arguments.length; i++)
        {
            sum += arguments[i];
        }
        let mean = sum / arguments.length;

        //Find summation
        let standDev = 0;
        for(var i = 0; i < arguments.length; i++)
        {
            standDev+= Math.pow((arguments[i] - mean), 2);
        }

        let y = standDev / arguments.length;
        let ret = Math.sqrt(y);

        return ret;
    }
}

console.log("Question 4: "+stdDev(1, 2, 3, 4));

//Question 5, compound interest
function compoundInterest(p, r, n)
{
    let x = p * Math.pow(1 + (r/100), n);
    return x;
}

console.log("Question 5: "+compoundInterest(1000, 20, 10));

//Question 6, return type without regex
function returnType(x)
{
    let ret ="";
    if (x % 1 ==0)
    {
        ret = "digit";
    }

    else if(65 <= x.charCodeAt(0) && x.charCodeAt(0) <= 90)
    {
        ret = "upper";
    }
    else if(97 <= x.charCodeAt(0) && x.charCodeAt(0) <= 122)
    {
        ret = "lower";
    }
    else
    {
        ret = "other";
    }
    return ret;
}

console.log("Question 6: "+returnType(4));
console.log("Question 6: "+returnType('A'));
console.log("Question 6: "+returnType('e'));
console.log("Question 6: "+returnType(']'));

//Question 7, create password that returns an object

function createIdPassword(first, last)
{
    const user = new Object();
    let num1 = first.length;
    let num2 = last.length;
    first = first.toUpperCase();
    last = last.toUpperCase();
    let f1 = first.charAt(0);
    let f2 = first.charAt(first.length-1);
    let l1 = last.substring(0, 3);
    user.id = f1 + last;
    user.password = f1 + f2 + l1 + num1 +num2;

    return user;
}
const fname = "John";
const lname = "Maxwell"
const q7user = createIdPassword(fname,lname);
console.log("Question 7:");
console.log(q7user);

//Question 8, remove duplicates from an array by creating a duplicate free one
function removeDuplicates(arr)
{
    let noDupes = [];
    let seen = [];

    for( var i = 0; i <arr.length; i++)
    {
        let str = arr[i];
        if( seen.indexOf(str) == -1)
        {
            noDupes.push(str);
            seen.push(str);
        }
    }

    return noDupes;
}
let a = ["tree", "cat", "box", "cat", "dog", "tree", "tree"];
console.log("Question 8: "+removeDuplicates(a));

//Question 9, mySort function that sorts three arrays by ascending last name
function mySort(arr1, arr2, arr3)
{
    //make sure all three arrays are the same length
    if ( arr1.length !== arr2.length || arr1.length !== arr3.length || arr2.length !== arr3.length)
    return null;

    //since every array is the same length, we can use the same length variable for every loop
    const length = arr1.length;

    for(let i = 0; i < length-1; i++)
    {
        let minVal = i;

        for( let j = i+1; j < length; j++)
        {
            if (arr1[j] < arr1[minVal])
            minVal = j;
        }

        if (minVal != i)
        {
            //arr1 swap
            const x = arr1[i];
            arr1[i] = arr1[minVal];
            arr1[minVal] = x;

            //arr2 swap
            const y = arr2[i];
            arr2[i] = arr2[minVal];
            arr2[minVal] = y;

            //arr3 swap
            const z = arr3[i];
            arr3[i] = arr3[minVal];
            arr3[minVal] = z;
        }
    }
}
//arrays for mySort
let names = ["Smith", "Bobbington", "K", "Lastname", "Aname", "Zname"];
let gpas = [4.0, 2.7, 3.8, 3.1, 2.9, 4.9];
let codes =[48170, 67483, 39205, 12345, 67583,99999];
mySort(names, gpas, codes);
console.log("Question 9: "+"\n"+"Names: "+names+"\n"+"GPAs: "+gpas+"\n"+"Zip Codes: "+codes);

//Question 10, myReverse function to reverse a string of text that reverses every other word
function myReverse(str)
{
    /*
    thought process for this one:
    split string into array
    reverse array
    loop through array setting a temp string equal to odd values in the array
    reverse the temp string
    (reversing temp string may require breaking it into a char array, reversing that array, then adding each value of the char array to a new variable)
    replace array value with reversed string
    create a string to put the reversed string array into
    return newly created string
    cannot use tostring
    */
    let words = str.split(" ");
    words.reverse();
    for(let i = 0; i < words.length-1; i++)
    {
        if (i % 2 == 0)
        {
            let temp = words[i];
            let tempArr = [];
            //create array to store characters
            for(let j = 0; j < temp.length; j++)
            {
                tempArr[j] = temp.charAt(j);
            }
            tempArr.reverse();
            let temp2 = "";
            for (let k = 0; k < tempArr.length; k++)
            {
                temp2 = temp2 + tempArr[k];
            }

            words[i] = temp2;
        }
    }
    let result = "";
    for(let l = 0; l < words.length-1; l++)
    {
        result = result + words[l] + " ";
    }
    result = result + words[words.length-1];

    return result;
}
console.log("Question 10: "+myReverse("tree is big green"));

//Question 11, ApplyFunctionToArray that takes a function and an array, and a number altering function
function timesTwo(num)
{
    return num * 2;
}

function ApplyFunctionToArray(f, p)
{
    for (let i = 0; i < p.length; i++)
    {
        p[i] = f(p[i]);
    }

    return p;
}
console.log("Question 11: "+ ApplyFunctionToArray(timesTwo, [1, 2, 3, 4, 5]));

//Question 12, Student class, constructors, isHonors method, toString method containing name and GPA
class Student
{
    constructor(name, gpa)
    {
        this.name = name;
        this.gpa = gpa;
    }

    getName()
    {
        return this.name;
    }

    getGPA()
    {
        return this.gpa;
    }

    setName(name)
    {
        this.name = name;
    }

    setGPA(gpa)
    {
        this.gpa = gpa;
    }

    isHonors(gpa)
    {
        if (gpa >= 3)
        return true;

        else
        return false;
    }

    toString(name, gpa)
    {
        let ret = "Name: "+name + " GPA: "+ gpa;
        return ret;
    }
}
var guy = new Student("kevin", 3.7);
console.log("Question 12: "+guy.isHonors(guy.gpa)+"\n"+guy.toString(guy.name, guy.gpa));

/*question 13, functions university and phone that use regex to determine if a string is a university ID or a phone number (or neither)
university format is E-0xxy-9yyx
phone format is xxx-xxx-xxxx
x is a digit and y is a lower case letter
functions simply return true or false*/
function university(str)
{
    if(str.search(/^E-0\d{2}[a-z]{1}-9[a-z]{2}\d{1}/) == 0)
        return true;

    return false;
}
function phone(str)
{

    if(str.search(/^\d{3}-\d{3}-\d{4}$/) == 0) 
        return true;

    return false;
}

console.log("Question 13: Is 111-222-3333 a phone number? "+ phone("111-222-3333") +"\n" +"Is E-085s-9ds1 an ID? "+ university("E-085s-9ds1") + "\n" +"Is 11-2222-33333 a phone number? "+ phone("11-2222-33333") +"\n" +"Is E-0q5S-91sD an ID? "+ university("E-0q5S-91sD"));

/*question 14, fullName function
most definitely uses regex
takes in string formatted as Prefix First M. Last
returns true or false*/
function fullName(str)
{
    if(str.search(/^(Mr|Mrs|Ms.) [A-Z][a-z]+ [A-Z]. [A-Z][a-z]+$/) == 0)
    return true;

    return false;
}

console.log("Question 14: Is Mr Bob B. Bobbington valid? "+fullName("Mr Bob B. Bobbington") + "\n"+"Is Mr Bob B. Bobbington valid? "+fullName("Mr Bob B. Bobbington") + "\n"+"Is Mr. Bob B. Bobbington valid? "+fullName("Mr. Bob B. Bobbington") +"\n"+ "Is Mr BOB B. Bobbington valid? "+fullName("Mr BOB B. Bobbington") + "\n"+ 
"Is Mr Bob B Bobbington valid? "+fullName("Mr Bob B Bobbington") + "\n"+"Is Mr Bob B. bobbington valid? "+fullName("Mr Bob B. bobbington") + "\n"+"Is Mr Bob   B. Bobbington valid? "+fullName("Mr Bob   B. Bobbington"));
