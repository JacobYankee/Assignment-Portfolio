(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 2 *)
(* Function name: smap *)
(* Description: Maps values *)
fun smap(_, nil) = nil
  | smap(F, x::xs) = F(x) ::smap(F, xs);
(* Function name: infront1 *)
(* Description: Inserts an element as the head of each element of a list *)
fun infront1(x, L) = smap(fn y => x::y, L);

infront1(1, [[1,2],nil,[3]]);