(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 2 *)
(* Function name: rmnil *)
(* Description: Removes all nil elements in a list list *)
fun rmnil(nil) = nil
  | rmnil(nil::tl) = rmnil tl
| rmnil(xs::tl) = xs :: rmnil tl;

rmnil([[1,2], nil, [3], nil, [4,5], nil]);