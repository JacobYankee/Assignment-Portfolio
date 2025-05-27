/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 4
 */
import java.util.*;
import java.io.*;

//Program tests travelling salesman solver
//Parameters in this file are for file2
public class AntTester2
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

        //initialize parameters for file2
        int size = fscan.nextInt();
        int edges = fscan.nextInt();
        int seed = 6010;
        int iterations = 300;
        double chemicalExponent = 0.7;
        double distanceExponent = 2.0;
        double initialDeposit = 0.07;
        int depositAmount = 50;
        double decayRate = 0.25;

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