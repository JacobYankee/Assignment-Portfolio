(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: product *)
(* Description: Computes the product of two integers *)
fun product(m, n) =
if m = 0
then 0
else
    if m < 0
    then ~n + product(m+1, n)
    else n + product(m-1, n);

product(2, 3);
product(~2, 3);
product(2, ~3);
product(~2, ~3);