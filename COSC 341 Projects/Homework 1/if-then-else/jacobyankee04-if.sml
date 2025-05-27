(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: pairStar *)
(* Description: Forms a new string where adjacent identical characters are separated by a * *)
fun pairStar(L) =
if null L
then nil
else
    if null (tl L)
    then hd L :: nil
    else
        if hd L = hd(tl L)
        then hd L :: #"*" :: pairStar(tl L)
        else hd L :: pairStar(tl L);
		
implode(pairStar(explode("xxyy")));
implode(pairStar(explode("aaaa")));