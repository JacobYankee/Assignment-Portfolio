(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 2 *)
(* Function name: neleHelp *)
(* Description: Helper function *)
fun neleHelp(_, 0) = nil
  | neleHelp(x, n) = x :: neleHelp(x, n-1);
(* Function name: concat *)
(* Description: Concatenation function *)
fun concat(nil, ys) = ys
  | concat(x::xs, ys) = x :: concat(xs, ys);
(* Function name: nele *)
(* Description: Repeats each element in a list n times *)
fun nele(nil, _) = nil
  | nele(x::xs, n) = concat(neleHelp(x, n) , nele(xs, n));

nele([1,2],3);