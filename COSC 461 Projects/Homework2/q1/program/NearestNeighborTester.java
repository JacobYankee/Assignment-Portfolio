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
        Scanner scan = new Scanner(System.in);

        //Ask user to enter training file
        System.out.println("Please enter the file path for the training data: ");
        String trainingPath = scan.nextLine();

        //Ask user to enter test file
        System.out.println("Please enter the file path for the test data: ");
        String testPath = scan.nextLine();

        //Ask user to enter output file
        System.out.println("Please enter the file path for the output data: ");
        String outputPath = scan.nextLine();

        //Close the scanner
        scan.close();
        
        //construct nearest neighbor classifier
        NearestNeighbor1 classifier = new NearestNeighbor1();

        //Convert training file, load training file
        String  trFile = "NNTraining1.txt";
        convertTrainingFile(trainingPath, trFile);
        double valError = classifier.loadTrainingData(trFile);

        //set nearest neighbors
        classifier.setParameters(NEIGHBORS);

        //Convert test data, classify test data
        String ttFile = "NNTest1.txt";
        convertTestFile(testPath, ttFile);
        classifier.classifyData(ttFile, outputPath);

        //Write validation error and k value to output file
        PrintWriter outFile = new PrintWriter(new FileWriter(outputPath, true));

        //print the validation error and k value to file
        outFile.println("\nValidation error: "+ valError + "\nK value: "+ NEIGHBORS);

        //Close printwriter
        outFile.close();

        
    }

    /*************************************************************************/

    //Method converts training file to numerical format
    private static void convertTrainingFile(String inputFile, String outputFile) throws IOException
    {
        //input and output files
        Scanner inF = new Scanner(new File(inputFile));
        PrintWriter outF = new PrintWriter(new FileWriter(outputFile));

        //read number of records, attributes, classes
        int numRecords = inF.nextInt();    
        int numAttributes = inF.nextInt();    
        int numClasses = inF.nextInt();

        //write number of records, attributes, classes
        outF.println(numRecords + " " + numAttributes + " " + numClasses);
        outF.flush();

        //Move to the next line after reading the specification lines
        inF.nextLine();

        //for each record
        for (int i = 0; i < numRecords; i++)    
        {                         
            //Check for whitespace to avoid empty string NumberFormatException
            if(!inF.hasNextLine())
            continue;

            String currentLine = inF.nextLine().trim();
            if(currentLine.isEmpty())
            continue;

            String[] details = currentLine.split("\\s+");

            //Normalize credit score between the given range of 500 and 900
            double creditScore = Double.parseDouble(details[0]);
            outF.print(normalizeValue(creditScore, 500, 900) + " ");

            //Normalize income between the given range of 30 and 90
            double incomeValue = Double.parseDouble(details[1]);
            outF.print(normalizeValue(incomeValue, 30, 90) + " ");

            //Normalize age betweem the given range of 30 and 80
            double ageValue = Double.parseDouble(details[2]);
            outF.print(normalizeValue(ageValue, 30, 80) + " ");

            //Convert sex and marital status values to numbers
            outF.print(convertSexToNumber(details[3]) + " ");
            outF.print(convertStatusToNumber(details[4]) + " ");

            //Convert and write class label
            int classLabel = convertRiskToNumber(details[5]);
            outF.println(classLabel);
            outF.flush();
        }

        //Close the scanner and printWriter
        inF.close();
        outF.close();
    }

    /*************************************************************************/

    //Method converts test file to numerical format, everything but class
    private static void convertTestFile(String inputFile, String outputFile) throws IOException
    {
        //input and output files
        Scanner inF = new Scanner(new File(inputFile));
        PrintWriter outF = new PrintWriter(new FileWriter(outputFile));

        //Check if first line contains number of records
        if(!inF.hasNextInt())
        {
            System.out.println("Error: File does not start with number of records.");
            inF.close();
            outF.close();
            return;
        }

        //read number of records
        int numberRecords = inF.nextInt();    

        //write number of records
        outF.println(numberRecords);

        //for each record
        for (int i = 0; i < numberRecords; i++)    
        {
            //Check for whitespace to avoid empty string NumberFormatException
            if(!inF.hasNextLine())
            continue;

            String currentLine = inF.nextLine().trim();
            if(currentLine.isEmpty())
            continue;

            String[] details = currentLine.split("\\s+");

            //Normalize credit score between the given range of 500 and 900
            double creditScore = Double.parseDouble(details[0]);
            outF.print(normalizeValue(creditScore, 500, 900) + " ");

            //Normalize income between the given range of 30 and 90
            double incomeValue = Double.parseDouble(details[1]);
            outF.print(normalizeValue(incomeValue, 30, 90) + " ");

            //Normalize age betweem the given range of 30 and 80
            double ageValue = Double.parseDouble(details[2]);
            outF.print(normalizeValue(ageValue, 30, 80) + " ");

            //Convert sex and marital status values to numbers
            outF.print(convertSexToNumber(details[3]) + " ");
            outF.print(convertStatusToNumber(details[4]) + " ");

            outF.println();
            outF.flush();
        }

        inF.close();
        outF.close();
    }

    /****************************************************************************/

    //Method converts sex to number
    private static double convertSexToNumber(String s)
    {
        if (s.equals("male"))
            return 0.0;
        else
            return 1.0;
    }

    //Method to convert marital status to number
    private static double convertStatusToNumber(String m)
    {
        if (m.equals("single"))
            return 0.0;
        else if (m.equals("married"))
            return 0.5;
        else
            return 1.0;

    }

    //Method to convert numbers with ranges to decimal values between zero and one such as credit score, age, and salary
    private static double normalizeValue(double input, double min, double max)
    {
        return (input-min) / (max - min);
    }

    //Method to convert risk level to number
    private static int convertRiskToNumber(String c)
    {
        if (c.equals("low"))
            return 1;
        else if (c.equals("medium"))
            return 2;
        else if (c.equals("high"))
            return 3;
        else
            return 4;
    }

}

