/*Jacob Yankee
 * COSC 461
 * Maniccam
 * Homework 1
 */
//Tester program for tic-tac with min-max, depth limit, 
//board evaluation, and alph-beta pruning
import java.util.*;
import java.io.*;
public class AlphaBetaTester
{
   //main program for tester
   public static void main(String[] args) throws FileNotFoundException
   {
      Scanner boardInput = new Scanner(System.in);
      Scanner scan = new Scanner(System.in);

      System.out.println("Enter a board size: ");
      int size = boardInput.nextInt();
      while(size % 2 != 0 || size > 6)
      {
         System.out.println("Error: Invalid size. \nEnter a board size: ");
         size = boardInput.nextInt();
      }

      System.out.println("Enter a name for the output file: ");
      String pathFile = scan.nextLine();
       //play tic-tac game
       AlphaBeta a = new AlphaBeta(size, pathFile);
	   a.play();

      boardInput.close();
      scan.close();
   }
}