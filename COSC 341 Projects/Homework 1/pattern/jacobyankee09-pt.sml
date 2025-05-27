(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: app *)
(* Description: A function that substitutes for @ *)
fun app(nil, y) = y
  | app(x, y) = hd x :: app(tl x, y);

(* Function name: int2list *)
(* Description: Takes an int and converts its digits to an int list *)
fun int2list(n) =
if n < 0 
then int2list(~n)
else 
    if n < 10 
    then n :: nil
    else app(int2list(n div 10), (n mod 10) :: nil);

(* Function name: int2str *)
(* Description: Converts an int list to a char list. Takes in both int and int list to determine whether or not a negative is needed. Returning as a string requires the use of implode in function call *)
fun int2str(n, L) =
if null L
then nil
else
    if n < 0
    then #"~" :: int2str(~n, L)
    else chr(hd L + 48) :: int2str(n, tl L);
	
implode(int2str(1234, int2list(1234)));
implode(int2str(~1234, int2list(~1234)));