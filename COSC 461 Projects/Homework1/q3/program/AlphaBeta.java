/*Jacob Yankee
 * COSC 461
 * Maniccam
 * Homework 1
 */
import java.util.*;
import java.io.*;

//This program plays tic-tac game using min-max, depth limit,
//board evaluation, and alpha-beta pruning
public class AlphaBeta
{
    private final char EMPTY = ' ';                //empty slot
    private final char COMPUTER = 'X';             //computer
    private final char PLAYER = '0';               //player
    private final int MIN = 0;                     //min level
    private final int MAX = 1;                     //max level
    private final int LIMIT = 6;                   //depth limit
    private int playerScore = 0;                   //player starting score
    private int cpuScore = 0;                      //computer starting score
    private PrintWriter fileOutput;                //print writer to write to file


    //Board class (inner class)
    private class Board
    {
        private char[][] array;                    //board array

        //Constructor of Board class
        private Board(int size)
        {
            array = new char[size][size];          //create array
                                             
            for (int i = 0; i < size; i++)         //fill array with empty slots   
                for (int j = 0; j < size; j++)
                    array[i][j] = EMPTY;
        }
    }

    private Board board;                           //game board
    private int size;                              //size of board
    
    //Constructor of AlphaBeta class
    public AlphaBeta(int size, String filePath) throws FileNotFoundException
    {
        this.board = new Board(size);              //create game board 
        this.size = size;                          //set board size
        this.fileOutput = new PrintWriter(filePath);
    }

    //Method plays game
    public void play()
    {
        while (true)                               //computer and player take turns
        {
            board = playerMove(board);             //player makes a move
            playerScore = getScore(board, PLAYER);
            System.out.println("Current scores:\nPlayer: "+ playerScore + "\nComputer: "+ cpuScore +"\n");
            fileOutput.println("Current scores:\nPlayer: "+ playerScore + "\nComputer: "+ cpuScore +"\n");
            fileOutput.flush();


            board = computerMove(board);           //computer makes a move
            cpuScore = getScore(board, COMPUTER);
            System.out.println("Current scores:\nPlayer: "+ playerScore + "\nComputer: "+ cpuScore +"\n");
            fileOutput.println("Current scores:\nPlayer: "+ playerScore + "\nComputer: "+ cpuScore +"\n");
            fileOutput.flush();

            if(full(board))
            break;
            
        }
        //Win conditionals are put outside of the while loop tomake sure everything works properly
        if (playerWin(board))                  //if player wins then game is over
            {
                System.out.println("Final scores:\n" + "Player: "+ playerScore + "\n" + "Computer: "+ cpuScore +"\nPlayer wins.");
                fileOutput.println("Final scores:\n" + "Player: "+ playerScore + "\n" + "Computer: "+ cpuScore +"\nPlayer wins.");
                fileOutput.flush();

            }
        if (computerWin(board))                //if computer wins then game is over
            {  
                System.out.println("Final scores:\n" + "Player: "+ playerScore + "\n" + "Computer: "+ cpuScore +"\nComputer wins.");
                fileOutput.println("Final scores:\n" + "Player: "+ playerScore + "\n" + "Computer: "+ cpuScore +"\nComputer wins.");   
                fileOutput.flush();                  

            }
        if (draw(board))                       //if draw then game is over
            {
                System.out.println("Final scores:\n" + "Player: "+ playerScore + "\n" + "Computer: "+ cpuScore +"\nDraw.");
                fileOutput.println("Final scores:\n" + "Player: "+ playerScore + "\n" + "Computer: "+ cpuScore +"\nDraw.");
                fileOutput.flush();
            }
                
    }

    //Method lets the player make a move
    private Board playerMove(Board board)
    {
        System.out.print("Player move: ");         //prompt player
        fileOutput.print("Player move: ");
        fileOutput.flush();
     
        Scanner scanner = new Scanner(System.in);  //read player's move
        int i = scanner.nextInt();
        int j = scanner.nextInt();
        if(board.array[i][j] != EMPTY)
        {
            System.out.println("Invalid move");
            fileOutput.println("Invalid move");
            fileOutput.flush();
            playerMove(board);
        }
        else if(board.array[i][j] == EMPTY)
        {
        board.array[i][j] = PLAYER;                //place player symbol
        System.out.println("A '0' was placed at ("+i+", "+j+")");
        fileOutput.println("A '0' was placed at ("+i+", "+j+")");
        fileOutput.flush();

        displayBoard(board);                       //diplay board
        System.out.println();
        }
        
        return board;                              //return updated board
    }

    //Method determines computer's move
    private Board computerMove(Board board)
    {                                              //generate children of board
        LinkedList<Board> children = generate(board, COMPUTER);

        long moveStart = System.currentTimeMillis();
        long moveLimit = 60000;

        int maxIndex = -1;
        int maxValue = Integer.MIN_VALUE;
        int cpuX = -1;
        int cpuY = -1;
                                                   //find the child with
        for (int i = 0; i < children.size(); i++)  //largest minmax value
        {
            int currentValue = minmax(children.get(i), MIN, 1, Integer.MIN_VALUE, Integer.MAX_VALUE, moveStart, moveLimit);
            if (currentValue > maxValue)
            {
                maxIndex = i;
                maxValue = currentValue;

                for(int h = 0; h < size; h++)
                {
                    for(int k = 0; k < size; k++)
                    {
                        if(board.array[h][k] == EMPTY && children.get(i).array[h][k] == COMPUTER)
                        {
                            cpuX = h;
                            cpuY = k;
                        }
                    }
                }
            }
        }

        Board result = children.get(maxIndex);     //choose the child as next move
                                                   
        System.out.println("Computer move:");
        fileOutput.println("Computer move:");
        fileOutput.flush();  

        displayBoard(result);                      //print next move
        System.out.println("An 'X' was placed at ("+cpuX+", "+cpuY+")");
        fileOutput.println("An 'X' was placed at ("+cpuX+", "+cpuY+")");
        fileOutput.flush();
        

        return result;                             //retun updated board
    }

    //Method computes minmax value of a board
    private int minmax(Board board, int level, int depth, int alpha, int beta, long moveStart, long moveLimit)
    {
        long moveCurrent = System.currentTimeMillis();

        if (computerWin(board) || playerWin(board) || draw(board) || depth >= LIMIT || moveCurrent - moveStart > moveLimit)
            return evaluate(board);                //if board is terminal or depth limit is reached
        else                                       //evaluate board
        {
            if (level == MAX)                      //if board is at max level     
            {
                 LinkedList<Board> children = generate(board, COMPUTER);
                                                   //generate children of board
                 int maxValue = Integer.MIN_VALUE;

                 for (int i = 0; i < children.size(); i++)
                 {                                 //find minmax values of children
                     int currentValue = minmax(children.get(i), MIN, depth+1, alpha, beta, moveStart, moveLimit);
                                                   
                     if (currentValue > maxValue)  //find maximum of minmax values
                         maxValue = currentValue;
                                                   
                     if (maxValue >= beta)         //if maximum exceeds beta stop
                         return maxValue;
                                                   
                     if (maxValue > alpha)         //if maximum exceeds alpha update alpha
                         alpha = maxValue;
                 }

                 return maxValue;                  //return maximum value   
            }
            else                                   //if board is at min level
            {                     
                 LinkedList<Board> children = generate(board, PLAYER);
                                                   //generate children of board
                 int minValue = Integer.MAX_VALUE;

                 for (int i = 0; i < children.size(); i++)
                 {                                 //find minmax values of children
                     int currentValue = minmax(children.get(i), MAX, depth+1, alpha, beta, moveStart, moveLimit);
                                     
                     if (currentValue < minValue)  //find minimum of minmax values
                         minValue = currentValue;
                                     
                     if (minValue <= alpha)        //if minimum is less than alpha stop
                         return minValue;
                                     
                     if (minValue < beta)          //if minimum is less than beta update beta
                         beta = minValue;
                 }

                 return minValue;                  //return minimum value 
            }
        }
    }

    //Method generates children of board using a symbol
    private LinkedList<Board> generate(Board board, char symbol)
    {
        LinkedList<Board> children = new LinkedList<Board>();
                                                   //empty list of children
        for (int i = 0; i < size; i++)
            for (int j = 0; j < size; j++)         //go thru board
                if (board.array[i][j] == EMPTY)
                {                                  //if slot is empty
                    Board child = copy(board);     //put the symbol and
                    child.array[i][j] = symbol;    //create child board
                    children.addLast(child);
                }

        return children;                           //return list of children
    }

    //Method checks whether computer wins
    private boolean computerWin(Board board)
    {
        return cpuScore > playerScore;             //check computer wins
    }                                              //somewhere in board

    //Method checks whether player wins
    private boolean playerWin(Board board)
    {
        return playerScore > cpuScore;               //check player wins
    }                                              //somewhere in board

    //Method checks whether board is draw
    private boolean draw(Board board)
    {                  
        //check board is full and neither computer nor player win                            
        return cpuScore == playerScore;
    }                   

    //Method checks whether row, column, or diagonal is occupied
    //by a symbol
    private boolean check(Board board, char symbol)
    {
        for (int i = 0; i < size; i++)             //check each row
            if (checkRow(board, i, symbol))
               return true;

        for (int i = 0; i < size; i++)             //check each column
            if (checkColumn(board, i, symbol))
                return true;

        if (checkLeftDiagonal(board, symbol))      //check left diagonal
            return true;

        if (checkRightDiagonal(board, symbol))     //check right diagonal
            return true;

        return false;                          
    }

    //Method checks whether a row is occupied by a symbol
    private boolean checkRow(Board board, int i, char symbol)
    {
        for (int j = 0; j < size; j++)
            if (board.array[i][j] != symbol)
                return false;

        return true;
    }

    //Method checks whether a column is occupied by a symbol
    private boolean checkColumn(Board board, int i, char symbol)
    {
        for (int j = 0; j < size; j++)
            if (board.array[j][i] != symbol)
                return false;

        return true;
    }

    //Method checks whether left diagonal is occupied a symbol
    private boolean checkLeftDiagonal(Board board, char symbol)
    {
        for (int i = 0; i < size; i++)
            if (board.array[i][i] != symbol)
               return false;

        return true;
    }

    //Method checks whether right diagonal is occupied by a symbol
    private boolean checkRightDiagonal(Board board, char symbol)
    {
        for (int i = 0; i < size; i++)
            if (board.array[i][size-1-i] != symbol)
               return false;

        return true;
    }

    //Method checks whether a board is full
    private boolean full(Board board)
    {
        for (int i = 0; i < size; i++)
            for (int j = 0; j < size; j++)
                if (board.array[i][j] == EMPTY)
                   return false;

        return true;
    }

    //Method makes copy of a board
    private Board copy(Board board)
    {
        Board result = new Board(size);      

        for (int i = 0; i < size; i++)       
            for (int j = 0; j < size; j++)
                result.array[i][j] = board.array[i][j];

        return result;                       
    }

    //Method displays a board
    private void displayBoard(Board board)
    {
        for (int i = 0; i < size; i++)
        {
            for (int j = 0; j < size; j++)
            {
                System.out.print(board.array[i][j]);
                fileOutput.print(board.array[i][j]);
                fileOutput.flush();
            }
                
            System.out.println();
            fileOutput.println();
            fileOutput.flush();
        }
    }

    //Method evaluates a board
    private int evaluate(Board board)
    {                          
            return cpuScore - playerScore;      //evaluation value is determined by the difference in score
    }
                                                   
    //Method to find score
    private int getScore(Board board, char symbol)
    {
        int score = 0;

        //Loop through array
        for(int i = 0; i < size; i++)
        {
            for(int j = 0; j < size; j++)
            {
                //Check if i+1 exists
                if (i+1 < size)
                {
                    if(board.array[i][j] == symbol && board.array[i+1][j] == symbol)
                    score+=2;

                    //Check if i+2 exists
                    if(i+2 < size)
                    {
                        if(board.array[i][j] == symbol && board.array[i+1][j] == symbol && board.array[i+2][j] == symbol)
                        score+=3;
                    }
                }

                //Check if j+1 exists
                if (j+1 < size)
                {
                    if(board.array[i][j] == symbol && board.array[i][j+1] == symbol)
                    score+=2;
                    
                    //Check if j+2 exists
                    if(j+2 < size)
                    {
                        if(board.array[i][j] == symbol && board.array[i][j+1] == symbol && board.array[i][j+2] == symbol)
                        score+=3;
                    }
                }
            }
        }
        return score;
    }
}
