/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 4
 */
import java.util.*;
import java.io.*;

//Program tests travelling salesman solver
//Parameters in this file are for file1
public class AntTester1
{
    /********************************************************************/

    //Main method
    public static void main(String[] args) throws IOException
    {
        //declare scanner
        Scanner scan = new Scanner(System.in);

        //get input file
        System.out.println("Enter the path of the input file: ");
        String inFile = scan.nextLine();

        //declare filescanner
        Scanner fscan = new Scanner(new File(inFile));

        //get output file
        System.out.println("Enter the path of the output file: ");
        String outFile = scan.nextLine();

        //close scanner
        scan.close();

        //initialize parameters for file1
        int size = fscan.nextInt();
        int edges = fscan.nextInt();
        int seed = 6500;
        int iterations = 20;
        double chemicalExponent = 2.0;
        double distanceExponent = 1.5;
        double initialDeposit = 0.05;
        int depositAmount = 75;
        double decayRate = 0.5;

        //create new matrix
        int[][] matrix = new int[size][size];
        createMatrix(matrix, size, edges, seed, fscan);

        //create ant program solver
        Ant ant = new Ant(matrix, size);

        //set parameters for ant
        ant.setParameters(iterations, chemicalExponent, distanceExponent, initialDeposit, depositAmount, decayRate, seed);

        //solve
        ant.solve(outFile, seed);

    }

    /*********************************************************************/

    //method creates adjacency matrix
    public static void createMatrix(int[][] matrix, int size, int edges, int seed, Scanner fscan)
    {
         //set diagonal to 0
         for (int i = 0; i < size; i++)
             matrix[i][i] = 0;

         //set random weights
         for (int i = 0; i < size; i++)
             for (int j = 0; j < i; j++)
             {
                fscan.nextInt();
                fscan.nextInt();
                matrix[i][j] = matrix[j][i] = fscan.nextInt();
             }
    }

    /**********************************************************************/
}