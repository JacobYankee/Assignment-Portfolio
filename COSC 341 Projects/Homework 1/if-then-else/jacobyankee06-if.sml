(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: compare *)
(* Function description: Helper function to compare if values in a list are equal *)
fun compare(n, L) =
if null L
then nil
else
    if n = hd L
    then compare(n, tl L)
    else hd L :: compare(n, tl L);

(* Function name: remvdub *)
(* Description: Removes duplicate values from a list *)
fun remvdub(L) = 
if null L
then nil
else hd L :: remvdub(compare(hd L, tl L));

remvdub(["a", "b", "a", "c", "b", "a"]);
remvdub(["a", "1", "1", "1", "b"]);
