(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: delnthc *)
(* Description: Deletes the n-th character in a string *)
fun delnthc(L, n) =
if null L
then nil
else
    if n = 1
    then delnthc(tl L, n-1)
    else hd L :: delnthc(tl L, n-1);

implode(delnthc(explode("abcdef"), 4));
implode(delnthc(explode("hihihi"), 2));