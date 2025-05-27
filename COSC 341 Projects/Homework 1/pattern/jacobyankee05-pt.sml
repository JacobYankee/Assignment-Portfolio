(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: remv *)
(* Description: Removes elements from list L that match value k *)
fun remv(_, nil) = nil
  | remv(k, x::xs) =
    if k = x then remv(k, xs)
    else x :: remv(k, xs);
	
remv("a", ["a", "b", "a", "c"]);
remv("4", ["1", "f", "4", "4"]);