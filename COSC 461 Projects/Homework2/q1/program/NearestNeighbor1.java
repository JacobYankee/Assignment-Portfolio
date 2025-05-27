/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 2
 */
import java.io.*;
import java.util.*;

//Nearest neighbor classifier
public class NearestNeighbor1
{
    /*************************************************************************/

    //Record class (inner class)
    private class Record 
    {
        private double[] attributes;         //attributes of record      
        private int className;               //class of record

        //Constructor of Record
        private Record(double[] attributes, int className)
        {
            this.attributes = attributes;    //set attributes 
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
    public NearestNeighbor1()
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
    public double loadTrainingData(String trainingFile) throws IOException
    {
         Scanner inFile = new Scanner(new File(trainingFile));

         //read number of records, attributes, classes
         numberRecords = inFile.nextInt();
         numberAttributes = inFile.nextInt();
         numberClasses = inFile.nextInt();

         //Initialize validation test number and validation test errors
         int validationTestNum;
         int validationError = 0;

         for(validationTestNum = 0; validationTestNum < numberRecords; validationTestNum++)
         {
            //New scanner to read through the file once more
            inFile = new Scanner(new File(trainingFile));
            //Purposely ignore next line
            inFile.nextLine();
            //create empty list of records
            records = new ArrayList<Record>();
            //Create an array to hold attributes and class number +1
            double[] valAttributes = new double[numberAttributes + 1];

            //for each record
            for(int i = 0; i < numberRecords; i++)
            {
                //Check to see if the validation test number is the current record
                if(validationTestNum == i)
                {
                    for(int j = 0; j < numberAttributes +1; j++)
                    {
                        valAttributes[j] = inFile.nextDouble();
                    }
                    continue;
                }

                //create attribute array
             double[] attributeArray = new double[numberAttributes]; 
                                     
             //read attribute values
             for (int j = 0; j < numberAttributes; j++)   
                  attributeArray[j] = inFile.nextDouble();  
 
             //read class name
             int className = inFile.nextInt();

             //create record
             Record record = new Record(attributeArray, className);

             //add record to list of records
             records.add(record);

            }

            //Add number of errors to itself and the validate method. A return of 1 signals there is an error
            validationError += validate(valAttributes);

            validationTestNum++;

         }
         //Find validation error
         double valError = 100 * (validationError / (double)numberRecords);
         //Print the validation error in the console
         System.out.println("Validation error: "+ valError);

         inFile.close();

         return valError;
    }

    /*************************************************************************/

    //Method sets number of nearest neighbors
    public void setParameters(int numberNeighbors)
    {
        this.numberNeighbors = numberNeighbors;
    }

    /*************************************************************************/

    //Method reads records from test file, determines their classes, 
    //and writes classes to classified file
    public void classifyData(String testFile, String classifiedFile) throws IOException
    {
         Scanner inFile = new Scanner(new File(testFile));
         PrintWriter outFile = new PrintWriter(new FileWriter(classifiedFile));

         //Read number of records
         int numberRecords = inFile.nextInt();
         //Print number of records to output file
         outFile.println(numberRecords);
         //Print empty line for formatting purposes
         outFile.println();
         outFile.flush();

         int readRecords = 0;
         //Loop through file as long as there are still records to check
         while (readRecords < numberRecords && inFile.hasNextLine())
         {
            //Create attribute array
            double[] attributeArray = new double[numberAttributes];
            boolean valid = true;

            //Read attribute values
            for(int j = 0; j < numberAttributes; j++)
                attributeArray[j] = inFile.nextDouble();

            //If a record is valid, find the class of attributes and write the class name
            if(valid)
            {
                int className = classify(attributeArray);
                outFile.println(convertNumberToRisk(className));
                outFile.flush();
                readRecords++;
            }
            //If the record is not valid, just skip it
            else
                inFile.nextLine();
         }

         //Close the input and output files
         inFile.close();
         outFile.close();
    }    
    /*************************************************************************/

    //Method determines the class of a set of attributes
    private int classify(double[] attributes)
    {
        //set size of arrays to numberRecords -1 due to leave one out validation
        double[] dist = new double[numberRecords - 1];
        int[] id = new int[numberRecords - 1];

        //find distances between attributes and all records
        for (int i = 0; i < numberRecords - 1; i++)
        {
            dist[i] = distance(attributes, records.get(i).attributes);
            id[i] = i;
        }

        //find nearest neighbors
        nearestNeighbor(dist, id);

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
            for (int j = i; j < numberRecords - 1; j++)
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

    //Method finds Euclidean distance between two points
    private double distance(double[] u, double[] v)
    {
        double distance = 0;         

        //Length v is used as there is no class number at the end of v
        for (int i = 0; i < v.length; i++)
            distance = distance + (u[i] - v[i])*(u[i] - v[i]);

        distance = Math.sqrt(distance); 
 
        return distance;               
    }

    /*************************************************************************/

    //Method validates classifier using validation file and displays error rate
    public int validate(double validationArray[]) throws IOException
    {
        //Read the class from the training file located at the last value in the array
        int actualClass = (int)validationArray[validationArray.length - 1];

        int predictedClass = classify(validationArray);
        if(predictedClass != actualClass)
            return 1;
        else
            return 0;
    }

    /*************************************************************************/
    //Method to convert numbers back to classes
    private String convertNumberToRisk(int c)
    {
        if(c == 1)
            return "low";
        else if(c == 2)
            return "medium";
        else if(c == 3)
            return "high";
        else if(c == 4)
            return "undetermined";
        else
            return "Error: Incorrect data";
    }

    /************************************************************************/
   
}

