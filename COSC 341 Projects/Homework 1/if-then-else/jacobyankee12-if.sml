(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 1 *)
(* Function name: power *)
(* Description: Calculates an exponent *)
fun power(x, y) =
if y = 0
then 1
else x * power(x, y - 1);

(* Function name: multinHelp *)
(* Description: A helper class that creates a list *)
fun multinHelp(a, b, c, d) =
if d = c 
then a * power(b, d) :: nil
else a * power(b, d) :: multinHelp(a, b, c, d + 1);

(* Function name: multin *)
(* Description: Takes list of three [a,b,c] and multiplies a by b c times, returns a list  of [a*b^0, a*b^1, ..., a*b^c] *)
fun multin(L) =
if null L
then nil
else
	let
		val a = hd L
		val b = hd(tl L)
		val c = hd(tl(tl L))
		val output = multinHelp(a,b,c,0)
	in
		output
	end;

multin([2,3,5]);
multin([3,4,5]);