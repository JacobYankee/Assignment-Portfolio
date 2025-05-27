/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 3
 */
import java.io.*;
import java.util.*;

//Program tests neural network in a specific application
public class NeuralNetworkTester3
{
    //Main method
    public static void main(String[] args) throws IOException
    {
        //Initialize Scanner
        Scanner scan = new Scanner(System.in);

        //Ask user to enter training file
        System.out.println("Please enter the file path for the training data: ");
        String trainingPath = scan.nextLine();

        //Ask user to enter validation file
        System.out.println("Please enter the file path for the validation data: ");
        String validatePath = scan.nextLine();

        //Ask user to enter test file
        System.out.println("Please enter the file path for the test data: ");
        String testPath = scan.nextLine();

        //Ask user to enter output file
        System.out.println("Please enter the file path for the output data: ");
        String outputPath = scan.nextLine();
        //create printwriter to print to output file from tester
        PrintWriter outF = new PrintWriter(new FileWriter(new File(outputPath), true));

        //Close the scanner
        scan.close();

        //construct neural network
        NeuralNetwork3 network = new NeuralNetwork3();

        //load training data
        network.loadTrainingData(trainingPath);

        //set parameters of network
        int seed = network.setParameters(5, 50000, 0.5, 5000);

        //train network
        network.train();

        //test network
        network.testData(testPath, outputPath);

        //validate network
        double meanError = network.validate(validatePath);

        //Print file requirements
        outF.println("\nValidation error: " +meanError+"\nHidden nodes: "+network.getMiddle()+"\nLearning rate: "+network.getRate()+"\nIterations: "+network.getIteration()+"\nSeed: "+seed);
        outF.close();
    }
}
