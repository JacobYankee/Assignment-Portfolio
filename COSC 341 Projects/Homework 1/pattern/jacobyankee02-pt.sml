(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: delnthc *)
(* Description: Deletes the n-th character in a string *)
fun delnthc (nil, _) = nil
  | delnthc (x::xs, 1) = delnthc (xs, 0)
  | delnthc (x::xs, n) = x :: delnthc (xs, n - 1);
  
implode(delnthc(explode("abcdef"), 4));
implode(delnthc(explode("hihihi"), 2));