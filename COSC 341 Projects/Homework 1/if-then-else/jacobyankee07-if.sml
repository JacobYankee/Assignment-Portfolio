(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: inc1 *)
(* Description: Increases the value of a second element in a tuple by one if the first element is the same as the given value *)
fun inc1(n, L:(int * int) list) =
if null L
then nil
else
    if #1(hd L) = n
    then (#1(hd L), #2(hd L) + 1) :: inc1(n, tl L)
    else hd L :: inc1(n, tl L);

inc1(2, [(1,1), (2,4), (4,5), (2,1)]);
inc1(4, [(4,4), (3,4), (4,1), (1,1)]);