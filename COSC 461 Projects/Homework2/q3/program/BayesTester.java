/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 2
 */
import java.io.*;
import java.util.*;

//Program tests Bayes classifier in specific application
public class BayesTester
{
    /*************************************************************************/

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

        //Create new PrintWriter for validation error
        PrintWriter outFile = new PrintWriter(new FileWriter(outputPath, true));

        //Close the scanner
        scan.close();

        //construct bayes classifier
        Bayes classifier = new Bayes();

        //Convert training file and load training data
        String  trFile = "bayesTrainingFile";
        convertTrainingFile(trainingPath, trFile);
        classifier.loadTrainingData(trFile);

        //convert test data
        String ttFile = "bayesTestFile";
        convertTestFile(testPath, ttFile);

        //compute probabilities
        classifier.computeProbability();

        //classify data
        classifier.classifyData(ttFile, outputPath);

        //Find and print the validation error
        double valError = classifier.validate(trFile);
        outFile.println("\nValidation error: "+ valError);
        System.out.println("Validation error: " + valError);
        outFile.close();

        
    }

    /****************************************************************************/

    //Method converts training file to numerical format
    private static void convertTrainingFile(String inputFile, String outputFile) throws IOException
    {
        //input and output files
        Scanner inFile = new Scanner(new File(inputFile));
        PrintWriter outFile = new PrintWriter(new FileWriter(outputFile));

        //read number of records, attributes, classes
        int numberRecords = inFile.nextInt(); 
        int numberAttributes = inFile.nextInt();
        int numberClasses = inFile.nextInt();

        //read attribute values
        int[] attributeValues = new int[numberAttributes];
        for (int i = 0; i < numberAttributes; i++)
            attributeValues[i] = inFile.nextInt();

        //write number of records, attributes, classes
        outFile.println(numberRecords + " " + numberAttributes + " " + numberClasses);

        //write attribute values
        for (int i = 0; i < numberAttributes; i++)
            outFile.print(attributeValues[i] + " ");
        outFile.println();

        //for each record
        for (int i = 0; i < numberRecords; i++)    
        {            
            int numLangs = inFile.nextInt() + 1;    //get number of languages
            outFile.print(numLangs + " ");

            String javaKnow = inFile.next();
            int javaNum = converJavaToNumber(javaKnow);     //convert java knowledge
            outFile.print(javaNum + " ");

            int yearsExp = inFile.nextInt() + 1;            //get years of experience
            outFile.print(yearsExp + " ");

            String major = inFile.next();
            int majorNum = convertMajorToNumber(major);     //convert major
            outFile.print(majorNum + " ");

            String grade = inFile.next();
            int gradeNum = convertGradeToNumber(grade);     //convert grade
            outFile.print(gradeNum + " ");

            String className = inFile.next();                    //convert class name
            int classNumber = convertClassToNumber(className);
            outFile.print(classNumber);                          
                     
            outFile.println();
        }

        inFile.close();
        outFile.close();
    }

    /****************************************************************************/
 
    //Method converts test file to numerical format
    private static void convertTestFile(String inputFile, String outputFile) throws IOException
    {
        //input and output files
        Scanner inFile = new Scanner(new File(inputFile));
        PrintWriter outFile = new PrintWriter(new FileWriter(outputFile));

        //read number of records
        int numberRecords = inFile.nextInt();    
    
        //write number of records
        outFile.println(numberRecords);

        //for each record
        for (int i = 0; i < numberRecords; i++)    
        {            
            int numLangs = inFile.nextInt() + 1;    //get number of languages
            outFile.print(numLangs + " ");

            String javaKnow = inFile.next();
            int javaNum = converJavaToNumber(javaKnow);     //convert java knowledge
            outFile.print(javaNum + " ");

            int yearsExp = inFile.nextInt() + 1;            //get years of experience
            outFile.print(yearsExp + " ");

            String major = inFile.next();
            int majorNum = convertMajorToNumber(major);     //convert major
            outFile.print(majorNum + " ");

            String grade = inFile.next();
            int gradeNum = convertGradeToNumber(grade);     //convert grade
            outFile.print(gradeNum + " ");

            outFile.println();
        }

        inFile.close();
        outFile.close();
    }

    /****************************************************************************/

    //Method converts marital status to number
    private static int convertGradeToNumber(String grade)
    {
        if (grade.equals("A"))
            return 1;
        else if (grade.equals("B"))
            return 2;
        else if (grade.equals("C"))   
            return 3;
        else
            return 4;
    }

    /****************************************************************************/

    //Method converts major to number
    private static int convertMajorToNumber(String major)
    {
        if (major.equals("cs"))
            return 1;
        else
            return 2;        
    }

    /****************************************************************************/

    //Method converts java knowledge to number
    private static int converJavaToNumber(String java)
    {
        if (java.equals("java"))
            return 1;
        else
            return 2;          
    }

    /****************************************************************************/

    //Method converts class name to number
    private static int convertClassToNumber(String className)
    {
        if (className.equals("interview"))
            return 1;
        else
            return 2;
    }

    /*****************************************************************************/
}


