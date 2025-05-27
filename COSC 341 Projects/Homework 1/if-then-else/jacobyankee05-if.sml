(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: remv *)
(* Description: Removes elements from list L that match value k *)
fun remv(k, L) =
if null L
then nil
else
    if k = hd(L)
    then remv(k, tl L)
    else hd(L) :: remv(k, tl L);

remv("a", ["a", "b", "a", "c"]);
remv("4", ["1", "f", "4", "4"]);