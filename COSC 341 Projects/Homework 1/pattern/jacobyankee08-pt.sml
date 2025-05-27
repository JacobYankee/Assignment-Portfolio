(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: min2 *)
(* Description: Finds the second smallest number in an integer list *)
fun min2(nil) = 0
    | min2(x::y::z::zs) = if x < y andalso x < z
    then 
        if y < z
        then y
        else min2(x::z::zs)
    else if y < z then min2(x::y::zs)
    else min2(x::z::zs);
	
min2([1,3,2,5,4]);
min2([3,12,6,4,9]);