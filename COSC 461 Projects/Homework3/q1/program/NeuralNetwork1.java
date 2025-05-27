/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 3
 */
import java.io.*;
import java.util.*;

//Neural network
public class NeuralNetwork1
{
    /*************************************************************************/

    //Record class
    private class Record 
    {
        private double[] input;     //inputs of record  
        private double[] output;    //outputs of record        

        //Constructor of Record
        private Record(double[] input, double[] output)
        {
            this.input = input;     //set inputs
            this.output = output;   //set outputs
        }
    }
    
    /*************************************************************************/

    private ArrayList<Record> records;   //list of training records
    private int numberRecords;           //number of training records 
         
    private int numberInputs;            //number of inputs 
    private int numberOutputs;           //number of outputs

    private int numberMiddle;            //number of hidden nodes
    private int numberIterations;        //number of iterations
    private double rate;                 //learning rate

    private double[] input;              //inputs
    private double[] middle;             //outputs at hidden nodes
    private double[] output;             //outputs at output nodes

    private double[] errorMiddle;        //errors at hidden nodes
    private double[] errorOut;           //errors at output nodes
    
    private double[] thetaMiddle;        //thetas at hidden nodes
    private double[] thetaOut;           //theats at output nodes

    private double[][] matrixMiddle;     //weights between input/hidden nodes 
    private double[][] matrixOut;        //weights between hidden/output nodes

    //vairables for normalization
    private double[] inputMin;          //minimum values in input columns
    private double[] outputMin;         //minimum values in output columns
    private double[] inputMax;          //maximum values in input columns
    private double[] outputMax;         //maximum values in output columns

    private double[][] limits;          //limits of output values

    /*************************************************************************/

    //Constructor of neural network
    public NeuralNetwork1()
    {
        //parameters are zero
        numberRecords = 0;       
        numberInputs = 0;
        numberOutputs = 0;
        numberMiddle = 0;        
        numberIterations = 0;
        rate = 0;

        //arrays are empty
        records = null;          
        input = null;            
        middle = null;
        output = null;
        errorMiddle = null;      
        errorOut = null;
        thetaMiddle = null;      
        thetaOut = null;
        matrixMiddle = null;     
        matrixOut = null;
    }

    /*************************************************************************/

    //Method loads training records from training file
    public void loadTrainingData(String trainingFile) throws IOException
    {
         Scanner inFile = new Scanner(new File(trainingFile));

         //read number of records, inputs, outputs
         numberRecords = inFile.nextInt();    
         numberInputs = inFile.nextInt();        
         numberOutputs = inFile.nextInt();
        
         //empty list of records
         records = new ArrayList<Record>();        

         //for each training record
         for (int i = 0; i < numberRecords; i++)    
         {
             //read inputs
             double[] input = new double[numberInputs];                                          
             for (int j = 0; j < numberInputs; j++) 
                 input[j] = inFile.nextDouble();
 
             //read outputs
             double[] output = new double[numberOutputs];
             for (int j = 0; j < numberOutputs; j++) 
                 output[j] = inFile.nextDouble();

             //create training record record
             Record record = new Record(input, output);

             //add record to list
             records.add(record);
         }

         inFile.close();
    }

    /*************************************************************************/

    //Method sets parameters of neural network
    //Method also returns the seed
    public int setParameters(int numberMiddle, int numberIterations, double rate,
    int seed)
    {
        //set hidden nodes, iterations, rate
        this.numberMiddle = numberMiddle;
        this.numberIterations = numberIterations;
        this.rate = rate;

        //initialize random number generation
        Random rand = new Random(seed);

        //create input/output arrays
        input = new double[numberInputs];
        middle = new double[numberMiddle];
        output = new double[numberOutputs];

        //create error arrays
        errorMiddle = new double[numberMiddle];
        errorOut = new double[numberOutputs];

        //initialize thetas at hidden nodes
        thetaMiddle = new double[numberMiddle];
        for (int i = 0; i < numberMiddle; i++)
            thetaMiddle[i] = 2*rand.nextDouble() - 1;
         
        //initialize thetas at output nodes
        thetaOut = new double[numberOutputs];
        for (int i = 0; i < numberOutputs; i++)
            thetaOut[i] = 2*rand.nextDouble() - 1;

        //initialize weights between input/hidden nodes
        matrixMiddle = new double[numberInputs][numberMiddle];
        for (int i = 0; i < numberInputs; i++)
            for (int j = 0; j < numberMiddle; j++)
                matrixMiddle[i][j] = 2*rand.nextDouble() - 1;

        //initialize weights between hidden/output nodes
        matrixOut = new double[numberMiddle][numberOutputs];
        for (int i = 0; i < numberMiddle; i++)
            for (int j = 0; j < numberOutputs; j++)
                matrixOut[i][j] = 2*rand.nextDouble() - 1;

        //return the seed as SetParameters is the only method that uses the seed
        return seed;
    }

    /*************************************************************************/

    //Method trains neural network
    public void train()
    {
        //repeat iteration number of times
        for (int i = 0; i < numberIterations; i++)
            //for each training record
            for (int j = 0; j < numberRecords; j++)
            {
                //calculate input/output
                forwardCalculation(records.get(j).input);

                //compute errors, update weights/thetas
                backwardCalculation(records.get(j).output);
            }
    }

    /*************************************************************************/

    //Method performs forward pass - computes input/output
    private void forwardCalculation(double[] trainingInput)
    {
        //feed inputs of record
        for (int i = 0; i < numberInputs; i++)
            input[i] = trainingInput[i];

        //for each hidden node
        for (int i = 0; i < numberMiddle; i++)
        {
            double sum = 0;

            //compute input at hidden node
            for (int j = 0; j < numberInputs; j++)
                sum += input[j]*matrixMiddle[j][i]; 
            
            //add theta
            sum += thetaMiddle[i];

            //compute output at hidden node
            middle[i] = 1/(1 + Math.exp(-sum));
        }        

        //for each output node
        for (int i = 0; i < numberOutputs; i++)
        {
            double sum = 0;

            //compute input at output node
            for (int j = 0; j < numberMiddle; j++)
                sum += middle[j]*matrixOut[j][i]; 
            
            //add theta
            sum += thetaOut[i];

            //compute output at output node
            output[i] = 1/(1 + Math.exp(-sum));
        }        
    }

    /*************************************************************************/

    //Method performs backward pass - computes errors, updates weights/thetas
    private void backwardCalculation(double[] trainingOutput)
    {
        //compute error at each output node
        for (int i = 0; i < numberOutputs; i++)
            errorOut[i] = output[i]*(1-output[i])*(trainingOutput[i]-output[i]);

        //compute error at each hidden node
        for (int i = 0; i < numberMiddle; i++)
        {
            double sum = 0;

            for (int j = 0; j < numberOutputs; j++)
                sum += matrixOut[i][j]*errorOut[j];                
         
            errorMiddle[i] = middle[i]*(1-middle[i])*sum;
        }

        //update weights between hidden/output nodes
        for (int i = 0; i < numberMiddle; i++)
            for (int j = 0; j < numberOutputs; j++)
                matrixOut[i][j] += rate*middle[i]*errorOut[j];

        //update weights between input/hidden nodes
        for (int i = 0; i < numberInputs; i++)
            for (int j = 0; j < numberMiddle; j++)
                matrixMiddle[i][j] += rate*input[i]*errorMiddle[j];

        //update thetas at output nodes
        for (int i = 0; i < numberOutputs; i++)
            thetaOut[i] += rate*errorOut[i];

        //update thetas at hidden nodes
        for (int i = 0; i < numberMiddle; i++)
            thetaMiddle[i] += rate*errorMiddle[i];
    }

    /*************************************************************************/

    //Method computes output of an input
    private double[] test(double[] input)
    {
        //forward pass input
        forwardCalculation(input);

        //return output produced
        return Arrays.copyOf(output, output.length);
    }

    /*************************************************************************/

    //Method reads inputs from input file, computes outputs, and writes outputs 
    //to output file
    public void testData(String inputFile, String outputFile) throws IOException
    {
         Scanner inFile = new Scanner(new File(inputFile));
         PrintWriter outFile = new PrintWriter(new FileWriter(outputFile));

        //create arraylists for record normalization
        ArrayList<Record> testIn = new ArrayList<>();
        ArrayList<Record> testOut = new ArrayList<>();

         //read number of records
         int numberRecords = inFile.nextInt();

         //for each record
         for (int i = 0; i < numberRecords; i++)
         {
             double[] input = new double[numberInputs];

             //read input from input file
             for (int j = 0; j < numberInputs; j++)
                  input[j] = inFile.nextDouble();
            //add to arraylist
            testIn.add(new Record(input, null));
         }

         //normalize data
         normalizeTest(testIn);

         //loop for record outputs
         for(int i = 0; i < numberRecords; i++)
         {
            //find output uisng neural network
            double[] output = test(testIn.get(i).input);

            //add output to testOut arraylist
            testOut.add(new Record(null, output));
         }

         //denormalize testOut data
         denormalize(testOut, limits);

         //write data to output file
         for (int i = 0; i < numberRecords; i++)
         {
            for(int j = 0; j < numberOutputs; j++)
            {
                outFile.print(testOut.get(i).output[j] + " ");
            }
            outFile.println();
         }

         inFile.close();
         outFile.close();
    }

    /*************************************************************************/

    //Method validates the network using the data from a file
    public double validate(String validationFile) throws IOException
    {
         Scanner inFile = new Scanner(new File(validationFile));

         //read number of records
         int numberRecords = inFile.nextInt();
         //initialize predictions arraylist
         ArrayList<Record> predictions = new ArrayList<>();
         //initialize validation arraylist
         ArrayList<Record> validations = new ArrayList<>();

         //initialize error
         double sumError = 0;

         //for each record
         for (int i = 0; i < numberRecords; i++)
         {
             //read inputs
             double[] input = new double[numberInputs];
             for (int j = 0; j < numberInputs; j++)
                  input[j] = inFile.nextDouble();

             //read actual outputs
             double[] actualOutput = new double[numberOutputs];
             for (int j = 0; j < numberOutputs; j++)
                  actualOutput[j] = inFile.nextDouble();

            //add records to validation arraylist
            validations.add(new Record(input, actualOutput));
         }

         //define denormalization limits
         double[][] limits = normalize(validations);

         //loop to get predicted outputs
         for(int i = 0; i < numberRecords; i++)
         {
            //find predicted output, add to arraylist
            double[] predictedOutput = test(validations.get(i).input);
            predictions.add(new Record(null, predictedOutput));

         }

         //denormalize validations and predictions
         denormalize(validations, limits);
         denormalize(predictions, limits);

         //Loop to find error
         for(int i = 0; i < numberRecords; i++)
         {
            //get error between actual and predicted output
            sumError += computeError(validations.get(i).output, predictions.get(i).output);

            //print actual output
            for(int j = 0; j < numberOutputs; j++)
            {
                System.out.print(validations.get(i).output[j] + " ");
            }
            System.out.println();

            //print predicted output
            for(int j = 0; j < numberOutputs; j++)
            {
                System.out.print(predictions.get(i).output[j] + " ");
            }
            System.out.println();
            System.out.println();
         }
         //display average error
         double meanError = sumError/numberRecords;
         System.out.println(meanError);

         inFile.close();
         return meanError;
    }

    /*************************************************************************/

    //Method finds root mean square error between actual and predicted output
    private double computeError(double[] actualOutput, double[] predictedOutput)
    {
        double error = 0;

        //sum of squares of errors
        for (int i = 0; i < actualOutput.length; i++)
            error += Math.pow(actualOutput[i] - predictedOutput[i], 2);

        //root mean square error
        return Math.sqrt(error/actualOutput.length);
    }    

    /*************************************************************************/
    //Getter methods for output file
    public int getMiddle()
    {
        return numberMiddle;
    }

    public int getIteration()
    {
        return numberIterations;
    }

    public double getRate()
    {
        return rate;
    }
    /*************************************************************************/

    //Method to determine normalization range for inputs
    public double[][] findInputRange(ArrayList<Record> data)
    {
        //initialize arrays
        inputMin = new double[numberInputs];
        outputMin = new double[numberOutputs];
        inputMax = new double [numberInputs];
        outputMax = new double[numberOutputs];
        //Fill inputs with arbitrarily large and small numbers
        Arrays.fill(inputMin, 9999999.9);
        Arrays.fill(inputMax, -9999999.9);

        //loop through records
        for (Record record : data)
        {
            for(int i = 0; i < numberInputs; i++)
            {
                inputMin[i] = Math.min(inputMin[i], record.input[i]);
                inputMax[i] = Math.max(inputMax[i], record.input[i]);
            }
            if(record.output != null)
            {
                for(int i = 0; i < numberOutputs; i++)
                {
                    outputMin[i] = Math.min(outputMin[i], record.output[i]);
                    outputMax[i] = Math.max(outputMax[i], record.output[i]);
                }
                
            }

        }

        return new double[][] {inputMin, inputMax};

    }
     /*************************************************************************/

    //Method to determine normalization range for outputs
    public double[][] findOutputRange(ArrayList<Record> data)
    {
        //initialize arrays
        inputMin = new double[numberInputs];
        outputMin = new double[numberOutputs];
        inputMax = new double [numberInputs];
        outputMax = new double[numberOutputs];
        //Fill inputs with arbitrarily large and small numbers
        Arrays.fill(inputMin, 9999999.9);
        Arrays.fill(inputMax, -9999999.9);

        //loop through records
        for (Record record : data)
        {
            for(int i = 0; i < numberInputs; i++)
            {
                inputMin[i] = Math.min(inputMin[i], record.input[i]);
                inputMax[i] = Math.max(inputMax[i], record.input[i]);
            }
            if(record.output != null)
            {
                for(int i = 0; i < numberOutputs; i++)
                {
                    outputMin[i] = Math.min(outputMin[i], record.output[i]);
                    outputMax[i] = Math.max(outputMax[i], record.output[i]);
                }
                
            }

        }

        return new double[][] {outputMin, outputMax};

    }
    /*************************************************************************/

    //normalize override method to be able to call in tester
    public void normalize()
    {
        normalize(this.records);
    }
     /*************************************************************************/

     //Normalization method for training/validation files
     public double[][] normalize(ArrayList<Record> data)
     {
        double[][] outputs = findOutputRange(data);

        //for each record
        for(Record record : data)
        {
            //normalize the inputs
            for(int i = 0; i < numberInputs; i++)
            {
                record.input[i] = (record.input[i] - inputMin[i]) / (inputMax[i] - inputMin[i]);
            }
            //check if output exists
            if(record.output != null)
            {
                //normalize the outputs
                for(int i = 0; i < numberOutputs; i++)
                {
                    record.output[i] = (record.output[i] - outputMin[i]) / (outputMax[i] - outputMin[i]);
                }
            }
        }

        //set limits equal to range
        limits = Arrays.copyOf(outputs, outputs.length);
        return outputs;
     }
     /*************************************************************************/

     //Normalization method for test data
     public double[][] normalizeTest(ArrayList<Record> data)
     {
        double[][] outputs = findInputRange(data);

        //for each record
        for(Record record : data)
        {
            //normalize the inputs
            for(int i = 0; i < numberInputs; i++)
            {
                record.input[i] = (record.input[i] - inputMin[i] / (inputMax[i] - inputMin[i]));
            }
            //check if output exists
            if(record.output != null)
            {
                //normalize the outputs
                for(int i = 0; i < numberOutputs; i++)
                {
                    record.output[i] = (record.output[i] - outputMin[i]) / (outputMax[i] - outputMin[i]);
                }
            }
        }

        return outputs;
     }
     /*************************************************************************/

     //Method for denormalization
     public void denormalize(ArrayList<Record> data, double[][] limits)
     {
        //for each record
        for(Record record : data)
        {
            for(int i = 0; i < numberOutputs; i++)
            {
                record.output[i] = record.output[i] * (limits[1][i] - limits[0][i]) + limits[0][i];
            }
        }
     }
}