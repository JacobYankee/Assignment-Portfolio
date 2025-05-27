/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 3
 */
import java.io.*;
import java.util.*;
/*****************************************************************************/

//Program tests knapsack solver
public class KnapsackTester
{
    //Main method
    public static void main(String[] args) throws IOException
    {
        //Initialize scanner
        Scanner scan = new Scanner(System.in);

        //Ask user to enter input file
        System.out.println("Please enter the file path for the input data: ");
        String inputPath = scan.nextLine();

        //Ask user to enter output file
        System.out.println("Please enter the file path for the output data: ");
        String outputPath = scan.nextLine();

        //Close scanner
        scan.close();

         //create knapsack solver
         Knapsack k = new Knapsack(inputPath);

         //set parameters of genetic algorithm, parameters work for both files
         int seed = k.setParameters(150, 10, 2000, 0.5, 0.05, 4329);

         //find near optimal solution
         k.solve(outputPath);

         //Write seed to output file
         PrintWriter outF = new PrintWriter(new FileWriter(outputPath, true));
         outF.println("Seed: "+seed);
         outF.close();
    }
}

/*****************************************************************************/