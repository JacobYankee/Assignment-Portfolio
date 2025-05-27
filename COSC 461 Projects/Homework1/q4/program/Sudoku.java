/*Jacob Yankee
 * COSC 461
 * Maniccam
 * Homework 1
 */
//This program solves sudoku puzzle using constraint satisfication, 
//backtracking, and recursion
import java.util.*;
import java.io.*;
public class Sudoku
{
    private int[][] board;                    //sudoku board
    private int size;                         //size of array, n^2
    private int area;                         //size^2
    private int square;                       //n
    private PrintWriter fileOutput;           //print writer to write to file

    //Constructor of Sudoku class
    public Sudoku(int[][] board, int size, String filePath) throws FileNotFoundException
    {
        this.board = board;                   //set initial board
        this.size = size;
        this.fileOutput = new PrintWriter(filePath);
        area = (size * size) -1;
        square = (int)Math.sqrt(size);
        
    }

    //Method solves a given puzzle
    public void solve()
    {                                         //fill the board starting
        if (fill(0))                          //at the beginning
           display();                         //if success display board
        else
           System.out.println("No solution"); //otherwise failure    
    }

    //Method fills a board using recursion/backtracking. 
    //It fills the board starting at a given location
    private boolean fill(int location)
    {
        int x = location/size;              //find x,y coordinates of
        int y = location%size;              //current location
        int value;
        
        if (location > area)               //if location exceeds board
            return true;                 //whole board is filled

        else if (board[x][y] > 0 || board[x][y] == -3)       //if location already has value or is blocked
            return fill(location+1);     //fill the rest of borad
        
        else if (board[x][y] == -1)     //board[x][y] = -1, odd number
        {
            for(value = 1; value <= size; value+=2)
            {
                board[x][y] = value;    //try odd numbers from 1 to size

                if(check(x, y) && fill(location+1))
                return true;
            }

            board[x][y] = -1;
            return false;
        }

        else if (board[x][y] == -2)     //board[x][y] = -2, even number
        {
            for(value = 2; value <= size; value+=2)
            {
                board[x][y] = value;    //try even numbers from 2 to size

                if(check(x, y) && fill(location+1))
                return true;
            }

            board[x][y] = -2;
            return false;
        }

        else                             //otherwise when board[x][y] = 0
        {
            for (value = 1; value <= size; value++)
            {
                board[x][y] = value;     //try numbers 1-size at the location

                if (check(x, y) && fill(location+1))
                    return true;         //if number causes no conflicts and the rest
            }                            //of board can be filled then done

            board[x][y] = 0;             //if none of numbers 1-size work then
            return false;                //empty the location and backtrack
        }
    }
    
    //Method checks whether a value at a given location causes any conflicts
    private boolean check(int x, int y)
    {
        int a, b, i, j;
        
        for (j = 0; j < size; j++)         //check value causes conflict in row
            if (j != y && board[x][j] == board[x][y])
                return false;   
                
        for (i = 0; i < size; i++)         //check value causes conflict in column
            if (i != x && board[i][y] == board[x][y])
                return false;
            
        a = (x/square)*square; b = (y/square)*square;       //check value causes conflict in
        for (i = 0; i < square; i++)         //square x square region
             for (j = 0; j < square; j++)
                 if ((a + i != x) && (b + j != y) && board[a+i][b+j] == board[x][y])
                     return false;
                     
        return true;
    }

    //Method displays a board
    private void display()
    {
        for (int i = 0; i < size; i++)
        {
            for (int j = 0; j < size; j++)
            {
                //convert -3 back to b
                if(board[i][j] == -3)
                {
                    System.out.print("b |");
                    fileOutput.print("b |");
                } 
                else
                {
                    System.out.print(board[i][j] + " |");
                    fileOutput.print(board[i][j] + " |");
                }
                
            }
                

            System.out.println();
            fileOutput.println();

            for (int j = 0; j < size; j++)
            {
                //loop to display horizontal lines now prints square amount of lines
                for(int k = 0; k < square; k++)
                {
                    System.out.print("-");
                    fileOutput.print("-");

                }
            }
                
            System.out.println();
            fileOutput.println();
            fileOutput.flush();
        }
    }
}