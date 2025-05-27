/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 3
 */
import java.io.*;
import java.util.*;

//Program tests neural network in a specific application
//This tester has parameters for the contents of file01
public class NeuralNetworkTester1A
{
    //Main method
    public static void main(String[] args) throws IOException
    {
        //Initialize Scanner
        Scanner scan = new Scanner(System.in);

        //Ask user to enter training file
        System.out.println("Please enter the file path for the training data: ");
        String trainingPath = scan.nextLine();

        //Ask user to enter test file
        System.out.println("Please enter the file path for the test data: ");
        String testPath = scan.nextLine();

        //Ask user to enter validation file
        System.out.println("Please enter the file path for the validation data: ");
        String validatePath = scan.nextLine();

        //Ask user to enter output file
        System.out.println("Please enter the file path for the output data: ");
        String outputPath = scan.nextLine();
        //create printwriter to print to output file from tester
        PrintWriter outF = new PrintWriter(new FileWriter(new File(outputPath), true));
        

        //Close the scanner
        scan.close();

        //construct neural network
        NeuralNetwork1 network = new NeuralNetwork1();

        //load training data
        network.loadTrainingData(trainingPath);

        //normalize data
        network.normalize();

        //set parameters of network, get seed in tester
        int seed = network.setParameters(3, 20000, 0.2, 2375);

        //train network
        network.train();

        //test network
        network.testData(testPath, outputPath);

        //validate network
        double meanError = network.validate(validatePath);

        //print necessary values
        outF.println("\nValidation error: "+meanError+"\nHidden nodes: "+network.getMiddle()+"\nLearning rate: "+network.getRate()+"\nIterations: "+network.getIteration()+"\nSeed: "+seed);

        //close printwriter
        outF.close();

    }
}
