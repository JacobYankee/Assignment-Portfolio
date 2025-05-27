(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: toupp *)
(* Description: Intakes a char list and converts lowercase letters to uppercase. using a string requires the use of both implode and explode in function call *)
  fun toupp(L) = 
if null L 
then nil
else 
    if ord(hd L) > 96 andalso ord(hd L) < 123
    then chr(ord (hd L) - 32) :: toupp(tl L)
    else chr(ord (hd L)) :: toupp(tl L);

implode(toupp(explode("programming")));
implode(toupp(explode("Abcd123!")));