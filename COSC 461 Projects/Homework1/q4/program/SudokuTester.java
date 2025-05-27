/*Jacob Yankee
 * COSC 461
 * Maniccam
 * Homework 1
 */
//Tester program for sudoku solver
import java.util.*;
import java.io.*;

public class SudokuTester
{
    //Main method for testing
    public static void main(String[] args)
    {   
        Scanner scan = new Scanner(System.in);
        System.out.println("Enter the input file:");
        String input = scan.nextLine();
        System.out.println("Enter the output file:");
        String output = scan.nextLine();

        try
        {
            File inputF = new File(input);
            Scanner scanF = new Scanner(inputF);
            int size = scanF.nextInt();
            int[][] board = new int[size][size];

            //Read file, convert w, o, e, and b to 0, -1, -2, and -3
            for(int i = 0; i < size; i ++)
            {
                for(int j = 0; j < size; j++)
                {
                    String val = scanF.next();
                    if(val.equals("w"))
                    {
                        board[i][j] = 0;
                    }
                    else if(val.equals("o"))
                    {
                        board[i][j] = -1;
                    }
                    else if(val.equals("e"))
                    {
                        board[i][j] = -2;
                    }
                    else if(val.equals("b"))
                    {
                       board[i][j] = -3; 
                    }
                    else
                    {
                        board[i][j] = Integer.parseInt(val);
                    } 
                }
            }

            scanF.close();
        
        //solve sudoku puzzle
        Sudoku s = new Sudoku(board, size, output);
        s.solve();
        }
        catch (Exception e)
        {
            System.out.println(e.getMessage());
        }
        finally
        {
            scan.close();
        }
    }
}