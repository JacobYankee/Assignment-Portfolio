/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 3
 */
import java.io.*;
import java.util.*;

//Program tests neural network in a specific application
public class NeuralNetworkTester2
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
        
        //Normalize the files
        String cTrain = "p2training";
        normalizeTraining(trainingPath, cTrain);
        String cVal = "p2validation";
        normalizeValidation(validatePath, cVal);
        String cTest = "p2test";
        normalizeTest(testPath, cTest);

        //construct neural network
        NeuralNetwork2 network = new NeuralNetwork2();

        //load training data
        network.loadTrainingData(cTrain);

        //set parameters of network
        int seed = network.setParameters(4, 100000, 0.5, 2375);

        //train network
        network.train();

        //test network
        network.testData(cTest, outputPath);

        //validate network
        double meanError = network.validate(cVal);

        //Print file requirements
        outF.println("\nValidation error: " +meanError+"\nHidden nodes: "+network.getMiddle()+"\nLearning rate: "+network.getRate()+"\nIterations: "+network.getIteration()+"\nSeed: "+seed);
        outF.close();
    }
    
    //Method to plug data into normalization formula
    private static double normalizeNum(double input, double min, double max)
    {
        return (input - min) / (max - min);
    }

    //method to normalize sex
    private static double normalizeSex(String s)
    {
        if(s.equals("male"))
            return 0.0;
        else
            return 1.0;
    }

    //Method to normalize marital status
    private static double normalizeMarriage(String m)
    {
        if(m.equals("single"))
            return 0.0;
        else if(m.equals("married"))
            return 0.5;
        else
            return 1.0;
    }

    //Method to normalize risk
    private static double normalizeRisk(String r)
    {
        //classes are set to 1/8, 3/8, 5/8, and 7/8 to create equal ranges for denormalization
        if (r.equals("low"))
            return 0.125;
        else if (r.equals("medium"))
            return 0.375;
        else if (r.equals("high"))
            return 0.625;
        else
            return 0.875;
    }

    //Method to normalize training file
    private static void normalizeTraining(String input, String output) throws IOException
    {
        //Input and output files
        Scanner inF = new Scanner(new File(input));
        PrintWriter outF = new PrintWriter(new FileWriter(output));

        //Read number of records, inputs, and outputs
        int numRecords = inF.nextInt();
        int numInputs = inF.nextInt();
        int numOutputs = inF.nextInt();

        //Write number of records, inputs, and outputs
        outF.println(numRecords +" "+ numInputs +" "+ numOutputs);
        outF.flush();

        //Move to the next line after reading the specification lines
        inF.nextLine();

        //for each record
        for (int i = 0; i < numRecords+1; i++)    
        {                         
            //Check for whitespace to avoid empty string NumberFormatException
            if(!inF.hasNextLine())
            continue;

            String currentLine = inF.nextLine().trim();
            if(currentLine.isEmpty())
            continue;

            String[] details = currentLine.split("\\s+");
            
            outF.println();
            //Normalize credit score between the given range of 500 and 900
            double creditScore = Double.parseDouble(details[0]);
            outF.print(normalizeNum(creditScore, 500, 900) + " ");

            //Normalize income between the given range of 30 and 90
            double incomeValue = Double.parseDouble(details[1]);
            outF.print(normalizeNum(incomeValue, 30, 90) + " ");

            //Normalize age betweem the given range of 30 and 80
            double ageValue = Double.parseDouble(details[2]);
            outF.print(normalizeNum(ageValue, 30, 80) + " ");

            //Convert sex and marital status values to numbers
            outF.print(normalizeSex(details[3]) + " ");
            outF.print(normalizeMarriage(details[4]) + " ");

            //Convert and write output
            double riskValue = normalizeRisk(details[5]);
            outF.print(riskValue);
            outF.flush();
        }

        //Close the scanner and printWriter
        inF.close();
        outF.close();
    }

    //Method to normalize validation file
    private static void normalizeValidation(String input, String output) throws IOException
    {
        //Input and output files
        Scanner inF = new Scanner(new File(input));
        PrintWriter outF = new PrintWriter(new FileWriter(output));

        //Read number of records
        int numRecords = inF.nextInt();

        //Write number of records
        outF.println(numRecords);
        outF.flush();

        //Move to the next line after reading the specification lines
        inF.nextLine();

        //for each record
        for (int i = 0; i < numRecords+1; i++)    
        {                         
            //Check for whitespace to avoid empty string NumberFormatException
            if(!inF.hasNextLine())
            continue;

            String currentLine = inF.nextLine().trim();
            if(currentLine.isEmpty())
            continue;

            String[] details = currentLine.split("\\s+");

            outF.println();
            //Normalize credit score between the given range of 500 and 900
            double creditScore = Double.parseDouble(details[0]);
            outF.print(normalizeNum(creditScore, 500, 900) + " ");

            //Normalize income between the given range of 30 and 90
            double incomeValue = Double.parseDouble(details[1]);
            outF.print(normalizeNum(incomeValue, 30, 90) + " ");

            //Normalize age betweem the given range of 30 and 80
            double ageValue = Double.parseDouble(details[2]);
            outF.print(normalizeNum(ageValue, 30, 80) + " ");

            //Convert sex and marital status values to numbers
            outF.print(normalizeSex(details[3]) + " ");
            outF.print(normalizeMarriage(details[4]) + " ");

            //Convert and write output
            double riskValue = normalizeRisk(details[5]);
            outF.print(riskValue);
            outF.flush();
        }

        //Close the scanner and printWriter
        inF.close();
        outF.close();
    }

    private static void normalizeTest(String input, String output) throws IOException
    {
        //Input and output files
        Scanner inF = new Scanner(new File(input));
        PrintWriter outF = new PrintWriter(new FileWriter(output));

        //Read number of records
        int numRecords = inF.nextInt();

        //Write number of records
        outF.println(numRecords);
        outF.flush();

        //Move to the next line after reading the specification lines
        inF.nextLine();

        //for each record
        for (int i = 0; i < numRecords+1; i++)    
        {                         
            //Check for whitespace to avoid empty string NumberFormatException
            if(!inF.hasNextLine())
            continue;

            String currentLine = inF.nextLine().trim();
            if(currentLine.isEmpty())
            continue;

            String[] details = currentLine.split("\\s+");

            outF.println();
            //Normalize credit score between the given range of 500 and 900
            double creditScore = Double.parseDouble(details[0]);
            outF.print(normalizeNum(creditScore, 500, 900) + " ");

            //Normalize income between the given range of 30 and 90
            double incomeValue = Double.parseDouble(details[1]);
            outF.print(normalizeNum(incomeValue, 30, 90) + " ");

            //Normalize age betweem the given range of 30 and 80
            double ageValue = Double.parseDouble(details[2]);
            outF.print(normalizeNum(ageValue, 30, 80) + " ");

            //Convert sex and marital status values to numbers
            outF.print(normalizeSex(details[3]) + " ");
            outF.print(normalizeMarriage(details[4]) + " ");
            
            outF.flush();
        }

        //Close the scanner and printWriter
        inF.close();
        outF.close();
    }
}
