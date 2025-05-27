(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: inc1 *)
(* Description: Increases the value of a second element in a tuple by one if the first element is the same as the given value *)
fun inc1(n, nil) = nil
  | inc1(n, (x, y) :: tl) =
    if x = n 
    then (x, y + 1) :: inc1(n, tl)
    else (x, y) :: inc1(n, tl);
	
inc1(2, [(1,1), (2,4), (4,5), (2,1)]);
inc1(4, [(4,4), (3,4), (4,1), (1,1)]);