/*Jacob Yankee
 * COSC 461
 * Maniccam
 * Homework 1
 */
import java.io.*;
import java.util.*;

//This program solves sliding puzzle using best first search.
//Misplacement and distance heuristics are used
public class SlidingBest
{
    private PrintWriter fileOutput;         //print writer to write to file
    //Board class (inner class)
    private class Board
    {
        private int[][] array;                 //board array
        private int hvalue;                     //heuristic value
        private Board parent;                   //parent board
        

        //Constructor of board class
        private Board(int[][] array, int size)
        {
            this.array = new int[size][size];  //create board array

            for (int i = 0; i < size; i++)      //copy given array
                for (int j = 0; j < size; j++)
                    this.array[i][j] = array[i][j];

            this.hvalue = 0;                    //heuristic value is 0

            this.parent = null;                 //no parent
        }
    }

    private Board initial;                         //initial board
    private Board goal;                            //goal board
    private int size;                              //board size

    //Constructor of SlidingBest class
    public SlidingBest(int[][] initial, int size, String filePath) throws FileNotFoundException
    {
        this.size = size;                          //set size of board
        this.initial = new Board(initial, size);   //create initial board
        this.goal = createGoalBoard();       //create gosl board
        this.fileOutput = new PrintWriter(filePath);
    }

    //Method solves sliding puzzle
    public void solve()
    {
         LinkedList<Board> openList = new LinkedList<Board>();  //open list
         LinkedList<Board> closedList = new LinkedList<Board>();//closed list

         openList.addFirst(initial);   //add initial board to open list     

         while (!openList.isEmpty())   //while open list has more boards
         {
             int best = selectBest(openList);       //select best board

             Board board = openList.remove(best);   //remove board
                                                    
             closedList.addLast(board);             //add board to closed list

             if (goal(board))                       //if board is goal
             {
                 displayPath(board);                //display path to goal
                 return;                            //stop search
             }
             else                                   //if board is not goal
             {
                 LinkedList<Board> children = generate(board);//create children

                 for (int i = 0; i < children.size(); i++)
                 {
                     Board child = children.get(i);  //for each child
                                                     
                     if (!exists(child, openList) && !exists(child, closedList))
                         openList.addLast(child);    //if child is not in open and
                 }                                   //closed lists then add it to
             }                                       //open list
         }

         System.out.println("no solution");          //no solution if there are no boards in open list
         fileOutput.println("no solution");
         fileOutput.flush();
    }                                                

    //Method creates children of a board
    private LinkedList<Board> generate(Board board)
    {
        LinkedList<Board> children = new LinkedList<Board>();
        for(int i = 0; i < size; i++)
        {
            for(int j = 0; j < size; j++)
            {
                //creates children based off whether j+1 or i+1 can be swapped
                if(j < size - 1 && canSwap(board.array[i][j], board.array[i][j + 1]))
                {
                    children.add(createChild(board, i, j, i, j+1));
                }
                if(i < size - 1 && canSwap(board.array[i][j], board.array[i + 1][j]))
                {
                    children.add(createChild(board, i, j, i+1, j));
                }
            }
        }
        return children;                        //return children      
    }

    //boolean method to check if a swap is possible
    private boolean canSwap(int a, int b)
    {
        if(a == b)
        return false;
        if((a >=1 || a == -1) && b == -2)
        return true;
        if((b >= 1 || b == -1) && a == -2)
        return true;
        if(a >=1 && b == -1)
        return true;
        if(b >= 1 && a == -2)
        return true;

        return false;
    }

    //Method creates a child of a board by swapping empty slot in a 
    //given direction
    private Board createChild(Board board, int i1, int j1, int i2, int j2)
    {
        Board child = copy(board);                   //create copy of board

        int temp = child.array[i1][j1];
        child.array[i1][j1] = child.array[i2][j2];
        child.array[i2][j2] = temp;
        child.hvalue = heuristic_M(child);           //set heuristic value

        child.parent = board;                        //assign parent to child

        return child;                                //return child
    }

    //Method computes heuristic value of board
    //Heuristic value is the number misplaced values
    private int heuristic_M(Board board)
    {
        int value = 0;                               //initial heuristic value

        for (int i = 0; i < size; i++)               //go thru board and
            for (int j = 0; j < size; j++)           //count misplaced values
                if (board.array[i][j] != goal.array[i][j])
                   value += 1;                       
  
        return value;                                //return heuristic value
    }
 
    //Method computes heuristic value of board
    //Heuristic value is the sum of taxi distances of misplaced values
    private int heuristic_D(Board board)
    {
        //initial heuristic value
        int value = 0;

        //go thru board
        for (int i = 0; i < size; i++)
            for (int j = 0; j < size; j++)
                //if value mismatches in goal board    
                if (board.array[i][j] != goal.array[i][j]) 
                {                                
                    //locate value in goal board
                    int x = 0, y = 0;         
                    boolean found = false;
                    for (x = 0; x < size; x++)
                    {                       
                        for (y = 0; y < size; y++)
                            if (goal.array[x][y] == board.array[i][j])
                            {                 
                                found = true; 
                                break;
                            } 
                        if (found)
                           break;                        
                    }
            
                    //find city distance between two locations
                    value += (int)Math.abs(x-i) + (int)Math.abs(y-j);
                }
                     
        //return heuristic value               
        return value;
    }

    //Method locates the board with minimum heuristic value in a
    //list of boards
    private int selectBest(LinkedList<Board> list)
    {
        int minValue = list.get(0).hvalue;           //initialize minimum
        int minIndex = 0;                            //value and location

        for (int i = 0; i < list.size(); i++)
        {
            int value = list.get(i).hvalue;
            if (value < minValue)                    //updates minimums if
            {                                        //board with smaller
                minValue = value;                    //heuristic value is found
                minIndex  = i;
            } 
        }

        return minIndex;                             //return minimum location
    }   

    //Method creates copy of a board
    private Board copy(Board board)
    {
        return new Board(board.array, size);
    }

    //Method decides whether a board is goal
    private boolean goal(Board board)
    {
        return identical(board, goal);            //compare board with goal
    }                                             

    //Method decides whether a board exists in a list
    private boolean exists(Board board, LinkedList<Board> list)
    {
        for (int i = 0; i < list.size(); i++)    //compare board with each
            if (identical(board, list.get(i)))   //element of list
               return true;

        return false;
    }

    //Method decides whether two boards are identical
    private boolean identical(Board p, Board q)
    {
        for (int i = 0; i < size; i++)
            for (int j = 0; j < size; j++)
                if (p.array[i][j] != q.array[i][j])
                    return false;      //if there is a mismatch then false

        return true;                   //otherwise true
    }

    //Method displays path from initial to current board
    private void displayPath(Board board)
    {
        LinkedList<Board> list = new LinkedList<Board>();

        Board pointer = board;         //start at current board

        while (pointer != null)        //go back towards initial board
        {
            list.addFirst(pointer);    //add boards to beginning of list

            pointer = pointer.parent;  //keep going back
        }
                                       //print boards in list
        for (int i = 0; i < list.size(); i++)  
            displayBoard(list.get(i));
    }

    //Method displays board
    private void displayBoard(Board board)
    {
        for (int i = 0; i < size; i++) //print each element of board
        {
            for (int j = 0; j < size; j++)
            {
                //Print -1 and -2 as R and G as expected
                if(board.array[i][j] == -1)
                {
                    System.out.print('R' +  " ");
                    fileOutput.print('R' + " ");
                }
                else if(board.array[i][j] == -2)
                {
                    System.out.print('G' +  " ");
                    fileOutput.print('G' + " ");
                }
                else
                {
                    System.out.print(board.array[i][j] + " ");
                    fileOutput.print(board.array[i][j] + " ");
                }
                
            }
                
            System.out.println();
            fileOutput.println();
        }   
        System.out.println();
        fileOutput.println();
        
        fileOutput.flush();
    }

    //method to create goal board
    private Board createGoalBoard()
    {
        int numInts = 0;
        int numRs = 0;
        int numGs = 0;

        //loop through array, count number of integers, reds, and greens
        for(int i = 0; i < size; i++)
        {
            for(int j = 0; j < size; j++)
            {
                if (initial.array[i][j] > 0)
                numInts++;
                else if(initial.array[i][j] == -1)
                numRs++;
                else if(initial.array[i][j] == -2)
                numGs++;
            }
        }

        //Create array of non-negative numbers and sort
        int[] ints = new int[numInts];
        int pos = 0;
        for(int i = 0; i < size; i++)
        {
            for(int j = 0; j < size; j++)
            {
                if(initial.array[i][j] > 0)
                {
                    ints[pos] = initial.array[i][j];
                    pos++;
                }
            }
        }
        Arrays.sort(ints);

        //create array for final board, insert sorted non-negative numbers followed by Reds and Greens
        int[][] finalBoard = new int[size][size];
        pos = 0;
        for(int i = 0; i < numInts; i++)
        {
            int x = pos / size;
            int y = pos % size;
            finalBoard[x][y] = ints[i];
            pos++;
        }

        for(int i = 0; i < numRs; i++)
        {
            int x = pos / size;
            int y = pos % size;
            finalBoard[x][y] = -1;
            pos++;
        }

        for(int i = 0; i < numGs; i++)
        {
            int x = pos / size;
            int y = pos % size;
            finalBoard[x][y] = -2;
            pos++;
        }

        return new Board(finalBoard, size);
    }
}
