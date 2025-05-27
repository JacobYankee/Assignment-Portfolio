(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: min2 *)
(* Description: Finds the second smallest number in an integer list *)
fun min2(L) =
if hd L < hd(tl L)
then
    if hd(tl L) < hd(tl (tl L))
    then hd(tl L)
    else min2((hd L) :: tl(tl L))
else
    if hd L < hd(tl(tl L))
    then hd L
    else min2(tl(tl L));

min2([1,3,2,5,4]);
min2([3,12,6,4,9]);