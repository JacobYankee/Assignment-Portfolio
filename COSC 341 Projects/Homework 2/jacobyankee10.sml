(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 2 *)
(* Function name: filter *)
(* Description: Filters a list *)
fun filter(_, nil) = nil
  | filter(P, x::xs) =
    if P(x) then x::filter(P, xs)
    else filter(P, xs);

(* Function name: range *)
(* Description: Finds the range between two numbers *)
fun range(0, 0) = nil
  | range(x, y) = if x > y then nil else x :: range(x+1, y);

(* Function name: plist *)
(* Description: Collects all prime numbers up to the given number *)
fun plist(n) =
    let
        fun isPrime(x) =
            let
                fun check(_, 1) = true
                    | check(y, z) =
                    if x mod y = 0 then false
                else check(y + 1, z - 1);
            in
                check(2, x div 2)
            end;
    in
        filter(isPrime, range(2, n))
    end;

plist(20);