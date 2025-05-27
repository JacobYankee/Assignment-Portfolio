(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: compare *)
(* Function description: Helper function to compare if values in a list are equal *)
    fun compare(_, nil) = nil
        | compare(n, x::xs) =
        if n = x 
        then compare(n, xs) 
        else x :: compare(n, xs);
(* Function name: remvdub *)
(* Description: Removes duplicate values from a list *)
fun remvdub(nil) = nil
  | remvdub(x::xs) = x :: remvdub(compare(x, xs));
  
remvdub(["a", "b", "a", "c", "b", "a"]);
remvdub(["a", "1", "1", "1", "b"]);