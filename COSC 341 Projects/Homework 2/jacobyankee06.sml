(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 2 *)
(* Function name: smap *)
(* Description: Maps values *)
fun smap(_, nil) = nil
  | smap(F, x::xs) = F(x) ::smap(F, xs);
(* Function name: chCase *)
(* Description: Converts input string to uppercase *)
fun chcaseHelp(L) = smap(fn x => if ord(x) >= 97 andalso ord(x) <= 122 then chr(ord(x)-32) else chr(ord (x)), L);
fun chCase(s) = implode(chcaseHelp(explode s));

chCase("ChCase");