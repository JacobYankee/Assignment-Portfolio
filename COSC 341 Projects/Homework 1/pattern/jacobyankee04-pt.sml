(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: pairStar *)
(* Description: Forms a new string where adjacent identical characters are separated by a * *)
fun pairStar(nil) = nil
  | pairStar [x] = [x]
  | pairStar (x :: y :: xs) =
      if x = y
      then x :: #"*" :: pairStar (y :: xs)
      else x :: pairStar (y :: xs);
	  
implode(pairStar(explode("xxyy")));
implode(pairStar(explode("aaaa")));