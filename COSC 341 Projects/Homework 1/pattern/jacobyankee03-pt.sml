(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: dispnthc *)
(* Description: Displays the n-th character in a string *)
fun dispnthc (x :: _, 1) = x
  | dispnthc (_ :: xs, n) = dispnthc (xs, n - 1);

dispnthc(explode("abcdef"), 4);
dispnthc(explode("kevin12"), 6);