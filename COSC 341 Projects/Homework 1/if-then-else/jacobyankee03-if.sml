(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: dispnthc *)
(* Description: Displays the n-th character in a string *)
fun dispnthc(L, n) =
if n = 1
then hd L
else dispnthc(tl L, n-1);

dispnthc(explode("abcdef"), 4);
dispnthc(explode("kevin12"), 6);