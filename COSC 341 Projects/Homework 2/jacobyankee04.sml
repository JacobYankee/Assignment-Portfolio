(* Jacob Yankee *)
(* COSC 341 *)
(* Zhang *)
(* Homework 2 *)
(* Function name: tri *)
(* Description: Returns a triangular number *)
fun tri(0) = 0
  | tri(x) = x + tri(x-1);
(* Function name: ntriHelp *)
(* Description: Creates a list in ascending order *)
fun ntriHelp(0, L) = L
  | ntriHelp(n, acc) = ntriHelp(n - 1, tri(n) :: acc);
(* Function name: ntri *)
(* Description: Generates a list of n triangular numbers from 1 *)
fun ntri(n) = ntriHelp(n, nil);

ntri(7);