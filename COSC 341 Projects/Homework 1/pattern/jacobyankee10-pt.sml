(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: char2num *)
(* Description: Converts a char 0-9 to int 0-9 *)
fun char2num n =
  if n < 10 then 0 else n - 48;

(* Function name: len *)
(* Description: Finds the length of a list *)
fun len(nil) = 0
  | len (x::xs) = len xs + 1;

(* Function name: exp *)
(* Description: Calculates an exponent *)
fun exp (n, 0) = 1
  | exp (n, m) = n * exp (n, m - 1);

(* Function name: str2int *)
(* Description: Converts a char list to an int. Using a string as input requires the use of explode in function call *)
    fun str2int(nil) = 0
  | str2int (#"~"::xs) = ~1 * str2int xs
  | str2int (x::xs) = (char2num (ord x) * exp (10, len xs)) + str2int xs;
  
str2int(explode("1234"));
str2int(explode("~1234"));