/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 2
 */

import java.io.*;
import java.util.*;

//Nearest neighbor classifier
public class NearestNeighbor2
{
    /*************************************************************************/

    //Record class (inner class)
    private class Record 
    {
        private int[] attributes;         //attributes of record      
        private int className;               //class of record

        //Constructor of Record
        private Record(int[] attributeArray, int className)
        {
            this.attributes = attributeArray;    //set attributes 
            this.className = className;      //set class
        }
    }

    /*************************************************************************/

    private int numberRecords;               //number of training records   
    private int numberAttributes;            //number of attributes   
    private int numberClasses;               //number of classes
    private int numberNeighbors;             //number of nearest neighbors
    private ArrayList<Record> records;       //list of training records

    /*************************************************************************/

    //Constructor of NearestNeighbor
    public NearestNeighbor2()
    {         
        //initial data is empty           
        numberRecords = 0;      
        numberAttributes = 0;
        numberClasses = 0;
        numberNeighbors = 0; 
        records = null;                        
    }

    /*************************************************************************/

    //Method loads data from training file
    public void loadTrainingData(String trainingFile) throws IOException
    {
         Scanner inFile = new Scanner(new File(trainingFile));

         //read number of records, attributes, classes
         numberRecords = inFile.nextInt();
         numberAttributes = inFile.nextInt();
         numberClasses = inFile.nextInt();

         //Create an array of pixels
         int[] pixelArray;

         //create empty list of records
         records = new ArrayList<Record>();        

         //for each record
         for (int i = 0; i < numberRecords; i++)    
         {
             //create attribute array
             pixelArray = new int[numberAttributes]; 
                                     
             //read attribute values
             for (int j = 0; j < numberAttributes; j++)
             {
                //insert value into array
                int pixel = inFile.nextInt();
                pixelArray[j] = pixel;
             }
 
             //read class name
             int className = inFile.nextInt();

             //create record
             Record record = new Record(pixelArray, className);

             //add record to list of records
             records.add(record);
         }

         inFile.close();
    }

    /*************************************************************************/

    //Method sets number of nearest neighbors
    public void setParameters(int numberNeighbors)
    {
        this.numberNeighbors = numberNeighbors;
    }

    /*************************************************************************/
    //Method to load data using leave one out validation
    void validateLOO(String trainingFile, int index) throws FileNotFoundException
    {
        Scanner inFile = new Scanner(new File(trainingFile));

        //read the number of records, attributes, and classes
        numberRecords = inFile.nextInt();
        numberAttributes = inFile.nextInt();
        numberClasses = inFile.nextInt();

        //Create an empty list of records
        records = new ArrayList<Record>();

        //Loop through for each record
        for(int i = 0; i < numberRecords; i++)
        {
            if(i == index)
                continue;
            //Create an array of attributes
            int[] attributeArray = new int[numberAttributes];

            //Read through attribute values
            for(int j = 0; j < numberAttributes; j++)
                attributeArray[j] = inFile.nextInt();
            
            //Read the class name
            int className = inFile.nextInt();

            //Create and add a record to the list of records
            Record record = new Record(attributeArray, className);
            records.add(record);
        }

        //close the scanner
        inFile.close();
    }
    /*************************************************************************/

    //Method reads records from test file, determines their classes, 
    //and writes classes to classified file
    public void classifyData(String testFile, String classifiedFile) throws IOException
    {
         Scanner inFile = new Scanner(new File(testFile));
         PrintWriter outFile = new PrintWriter(new FileWriter(classifiedFile));

         //read number of records
         int numberRecords = inFile.nextInt();

         //write number of records
         outFile.println(numberRecords);
         //print an empty line for formatting purposes
         outFile.println();

         //for each record
         for (int i = 0; i < numberRecords; i++)
         {
             //create attribute array
             int[] attributeArray = new int[numberAttributes];

             //Read attributes
             for(int j = 0; j < numberAttributes; j++)
             {
                attributeArray[j] = inFile.nextInt();
             }

             //find class of attributes
             int className = classify(attributeArray) - 1;

             //write class name
             outFile.println(className);
             outFile.flush();
         }

         inFile.close();
         outFile.close();
    }    

    /*************************************************************************/

    //Method determines the class of a set of attributes
    private int classify(int[] attributes)
    {
        double[] distance = new double[numberRecords];
        int[] id = new int[numberRecords];

        //find distances between attributes and all records
        for (int i = 0; i < numberRecords -1; i++)
        {
            distance[i] = distance(attributes, records.get(i).attributes);
            id[i] = i;
        }

        //find nearest neighbors
        nearestNeighbor(distance, id);

        //find majority class of nearest neighbors
        int className = majority(id);

        //return class
        return className;
    }

    /*************************************************************************/

    //Method finds the nearest neighbors
    private void nearestNeighbor(double[] distance, int[] id)
    {
        //sort distances and choose nearest neighbors
        for (int i = 0; i < numberNeighbors; i++)
            for (int j = i; j < numberRecords; j++)
                if (distance[i] > distance[j])
                {
                    double tempDistance = distance[i];
                    distance[i] = distance[j];
                    distance[j] = tempDistance;

                    int tempId = id[i];
                    id[i] = id[j];
                    id[j] = tempId;
                }
    }

    /*************************************************************************/

    //Method finds the majority class of nearest neighbors
    private int majority(int[] id)
    {
        double[] frequency = new double[numberClasses];

        //class frequencies are zero initially
        for (int i = 0; i < numberClasses; i++)
            frequency[i] = 0;

        //each neighbor contributes 1 to its class
        for (int i = 0; i < numberNeighbors; i++)
            frequency[records.get(id[i]).className - 1] += 1;

        //find majority class
        int maxIndex = 0;                         
        for (int i = 0; i < numberClasses; i++)   
            if (frequency[i] > frequency[maxIndex])
               maxIndex = i;

        return maxIndex + 1;
    }

    /*************************************************************************/

    //Method finds binary distance between two points
    private double distance(int[] attributeArray, int[] attribute)
    {
        int mismatches = 0;

        for(int i = 0; i < attributeArray.length; i++)
        {
            if(attributeArray[i] != attribute[i]) 
            mismatches++;
        }

        //normalize by length
        return (double) mismatches / attributeArray.length;          
    }

    /*************************************************************************/

    //Method validates classifier using validation file and displays error rate
    public double validate(String validationFile) throws IOException
    {
         Scanner inFile = new Scanner(new File(validationFile));

         //read number of records
         int numberRecords = inFile.nextInt();

         //initially zero errors
         int numberErrors = 0;

         //for each record
         for (int i = 0; i < numberRecords; i++)
         {
             int[] attributeArray = new int[numberAttributes];

             //read attributes
             for (int j = 0; j < numberAttributes; j++)
                  attributeArray[j] = inFile.nextInt();

             //read actual class
             int actualClass = inFile.nextInt();

             //find class predicted by classifier
             int predictedClass = classify(attributeArray) - 1;

             //errror if predicted and actual classes do not match
             if (predictedClass != actualClass)
                numberErrors += 1;
         }
 
         //find and print error rate
         double errorRate = 100.0*numberErrors/numberRecords;
         System.out.println("validation error: " + errorRate + "%");

         inFile.close();
         return errorRate;
    }

    /************************************************************************/
}

