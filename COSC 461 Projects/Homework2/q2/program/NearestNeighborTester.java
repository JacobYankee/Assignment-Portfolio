/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 2
 */

import java.io.*;
import java.util.*;

//Program tests nearest neighbor classifier in a specific application
public class NearestNeighborTester
{
    /*************************************************************************/

    //number of nearest neighbors
    private static final int NEIGHBORS = 5;

    //Main method
    public static void main(String[] args) throws IOException
    {
        //create scanner
        Scanner scan = new Scanner(System.in);
        
        //initialize validation error varaible
        double valError;

        //Ask user for training file path
        System.out.println("Please enter the file path for the training data: ");
        String trainingPath = scan.nextLine();

        //Ask the user for test file path
        System.out.println("Please enter the file path for the test data: ");
        String testPath = scan.nextLine();

        //Ask the user for the output path
        System.out.println("Please enter the file path for the output file: ");
        String outPath = scan.nextLine();
        
        //Create a new printwriter that points to output file
        PrintWriter outFile = new PrintWriter(new FileWriter(outPath, true));

        //Initialize the classifier
        NearestNeighbor2 classifier = new NearestNeighbor2();

        //Load the training data
        classifier.loadTrainingData(trainingPath);

        //Set the parameters from the nearest neighbor K value
        classifier.setParameters(NEIGHBORS);

        //Classify the test data and write the output to the output file
        classifier.classifyData(testPath, outPath);

        //Find the validation error and print to the terminal and the file
        valError = classifier.validate(trainingPath);
        System.out.println("Validation error: " + valError);
        //Print both validation error and nearest neighbors to file
        outFile.println("\nValidation error: " + valError + "\nNumber of nearest neighbors: "+ NEIGHBORS);

        //close scanner and printwriter
        scan.close();
        outFile.close();

    }

    /*************************************************************************/

}

