(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 2 *)
(* Function name: factHelp *)
(* Description: helper function for isfact *)
fun factHelp(num, divisor, acc, n) =
    if acc = n then true
    else if acc > n then false
    else factHelp(num+1, divisor*(num+1), acc*(num+1), n);
(* Function name: isfact *)
(* Description: Determines if a positive integer is a factorial number *)
fun isfact n = factHelp(1, 1, 1, n);

isfact(120);