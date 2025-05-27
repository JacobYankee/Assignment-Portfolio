(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: char2num *)
(* Description: Converts a char 0-9 to int 0-9 *)
fun char2num(n) =
if n < 10
then 0
else (n - 48);

(* Function name: len *)
(* Description: Finds the length of a list *)
fun len(L) =
if null L
then 0
else len(tl L) + 1;

(* Function name: exp *)
(* Description: Calculates an exponent *)
fun exp(n, m) =
if m = 0
then 1
else n * exp(n, m-1);

(* Function name: str2int *)
(* Description: Converts a char list to an int. Using a string as input requires the use of explode in function call *)
fun str2int(L) =
if null L
then 0
else 
    if hd L = #"~"
    then ~1 * str2int(tl L)
    else (char2num(ord(hd L)) * exp(10, len(tl L)))+ str2int(tl L);
	
str2int(explode("1234"));
str2int(explode("~1234"));