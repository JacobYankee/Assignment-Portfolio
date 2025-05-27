/*Jacob Yankee
 * COSC 461
 * Maniccam
 * Homework 1
 */
import java.util.*;
import java.io.*;
//Tester program for sliding board solver with A* search
public class SlidingAstarTester
{
    //main method for testing
    public static void main(String[] args)
    {   
        Scanner scan = new Scanner(System.in);
        System.out.println("Enter the input file:");
        String inputF = scan.nextLine();
        System.out.println("Enter the output file:");
        String outputF = scan.nextLine();

        try
        {
            File input = new File(inputF);
            Scanner fScan = new Scanner(input);
            
            //create board arrays
            int size = fScan.nextInt();
            int[][] initial = new int[size][size];
            int[][] goal = new int[size][size];

            //create initial board
            for(int i = 0; i < size; i++)
            {
                for(int j = 0; j < size; j++)
                {
                    int val = fScan.nextInt();
                    initial[i][j] = val;
                }
            }

            //create goal board
            for(int i = 0; i < size; i++)
            {
                for(int j = 0; j < size; j++)
                {
                    int val = fScan.nextInt();
                    goal[i][j] = val;
                }
            }

            //get evaluation and heuristic values
            int evaluation = fScan.nextInt();
            int heuristic = fScan.nextInt();

            fScan.close();

            SlidingAstar s = new SlidingAstar(initial, goal, size, evaluation, heuristic, evaluation, heuristic, outputF);
            s.solve();
        }
        catch (FileNotFoundException e)
        {
            System.out.println("File not found: " +e.getMessage());
        }
        finally
        {
            scan.close();
        }
        
    }
}

