(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: toupp *)
(* Description: Intakes a char list and converts lowercase letters to uppercase. using a string requires the use of both implode and explode in function call *)
fun toupp(nil) = nil
  | toupp(x::xs) =
    if ord(x) > 96 andalso ord(x) < 123
    then chr(ord x - 32) :: toupp(xs)
    else chr(ord x) :: toupp(xs);
	
implode(toupp(explode("programming")));
implode(toupp(explode("Abcd123!")));