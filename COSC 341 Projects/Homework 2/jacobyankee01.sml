(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 2 *)
(* Function name: helper *)
(* Description: Helper function for inde *)
fun helper(x, nil, _, result) = result
    | helper(x, y::ys, z, result) =
    if y = x then
    helper(x, ys, z + 1, z::result)
      else
  helper(x, ys, z + 1, result);
(* Function name: inde *)
(* Description: Returns the index of the occurence of a given value, starting from 1 *)
fun inde(x, L) =
    let
    val result = helper(x, L, 1, nil)
    in
    rev result
    end;

inde(1, [1,2,1,1,2,2,1]);