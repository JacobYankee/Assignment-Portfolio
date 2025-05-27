/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 4
 */
import java.util.*;
import java.io.*;

//Program uses ant algorithm to solve travelling salesman problem
public class Ant
{
    private int numberVertices;       //number of vertices
    private int numberAnts;           //number of ants
    private int numberIterations;     //number of iterations
    private double chemicalExponent;  //chemical exponent
    private double distanceExponent;  //distance exponent 
    private double initialDeposit;    //initial deposit per edge
    private double depositAmount;     //deposit amount per iteration
    private double decayRate;         //decay rate
    private Random random;            //random number generator
 
    private int[][] matrix;           //adjacency matrix
    private double[][] chemical;      //chemical matrix
    private int[][] cycle;            //cycles of ants
    private int[] solution;           //best solution

    //Constructor of Ant class
    public Ant(int[][] matrix, int numberVertices)
    {
        //set number of vertices and ants
        this.numberVertices = numberVertices;
        this.numberAnts = numberVertices;

        //create necessary matrices and arrays
        this.matrix = matrix;
        this.chemical = new double[numberVertices][numberVertices]; 
        this.cycle = new int[numberAnts][numberVertices];
        this.solution = new int[numberVertices];
    }

    //Method sets parameters of algorithm
    public void setParameters(int numberIterations, double chemicalExponent, double distanceExponent, 
    double initialDeposit, double depositAmount, double decayRate,  int seed)
    {
        //set parameters
        this.numberIterations = numberIterations;
        this.chemicalExponent = chemicalExponent;
        this.distanceExponent = distanceExponent;
        this.initialDeposit = initialDeposit;
        this.depositAmount = depositAmount;
        this.decayRate = decayRate;
        this.random = new Random(seed);  
    }
  
    //Method runs the ant algorithm
    public void solve(String outFile, int seed) throws IOException
    {
        //initialize chemical matrix and best cycle
        initialize();

        //perform iterations
        for (int i = 0; i < this.numberIterations; i++)
        {
             //move ants thru cycles
             moveAnts();

             //update best solution
             updateSolution();

             //update chemicals on edges
             updateChemical();
        }

        //display best solution
        bestSolution(outFile, seed);
    }

    //Method initializes chemical matrix and best solution
    private void initialize()
    {
        //assign constant amount of chemical to all edges 
        for (int i = 0; i < numberVertices; i++)
            for (int j = 0; j < numberVertices; j++)
                if (i == j)
                   chemical[i][i] = 0;
                else 
                   chemical[i][j] = initialDeposit; 

        //initial best solution is 0 1 2 . . .vertices
        for (int i = 0; i < numberVertices; i++)
            solution[i] = i;
    } 

    //Method moves ants thru cycles
    private void moveAnts()
    {
        //for each ant 
        for (int i = 0; i < numberAnts; i++)
            //find a cycle by successively finding vertices
            for (int j = 0; j < numberVertices; j++)
                cycle[i][j] = nextVertex(i, j);
    }

    //Method finds the next vertex of an ant
    private int nextVertex(int i, int j)
    {
        //starting vertex of each ant is ant number
        if (j == 0)
            return i;
        else
        {
            //create a list
            LinkedList<Integer> list = new LinkedList<Integer>();

            //put all vertices into list
            for (int k = 0; k < numberVertices; k++)
                list.addLast(k);

            //remove vertices of partial cycle of ant
            for (int k = 0; k < j; k++)
                list.removeFirstOccurrence(cycle[i][k]);

            //find number of remaining vertices
            int size = list.size();

            //array of fitness values of remaining vertices
            double[] values = new double[size];

            //compute fitness values of remaining vertices
            for (int k = 0; k < size; k++)
            {
                //chemical part of fitness value
                double chemicalPart = chemical[cycle[i][j-1]][list.get(k)];

                //distance part of fitness value
                double distancePart = 1.0/matrix[cycle[i][j-1]][list.get(k)];

                //fitness value is combination of chemical part and distance part
                values[k] = Math.pow(chemicalPart, chemicalExponent)*Math.pow(distancePart, distanceExponent);
            }

            //find accumulated fitness values
            for (int k = 1; k < size; k++)
                values[k] = values[k] + values[k-1];

            //normalize the accumulated fitness values
            for (int k = 0; k < size; k++)
                values[k] = values[k]/values[size-1];   

            //create a random number
            double r = random.nextDouble();

            //pick a vertex using random number and fitness values
            int k;
            for (k = 0; k < size; k++)
            if (r <= values[k])
                break;

            //return picked vertex
            return list.get(k);
        }
    }

    //Method updates the best cycle found
    private void updateSolution()
    {
        //look at the cycles of all ants
        for (int i = 0; i < numberAnts; i++)
            //if smaller cycle is found then update the best cycle
            if (length(cycle[i]) < length(solution))
            {
                for (int j = 0; j < numberVertices; j++)
                    solution[j] = cycle[i][j];
            }  
    }

    private void updateChemical()
    {
        //create deposit array
        double[][] deposit = new double[numberVertices][numberVertices];
        
        //deposit amount is initially zero
        for (int i = 0; i < numberVertices; i++)
            for (int j = 0; j < numberVertices; j++)
                deposit[i][j] = 0;
        
        //for each ant 
        for (int i = 0; i < numberAnts; i++)
        {
            //find its cycle length 
            int pathLength = length(cycle[i]);
 
            //go thru cycle
            for (int j = 0; j < numberVertices; j++)
            {
                //for each edge on the cycle
                int u = cycle[i][j];
                int v = cycle[i][(j+1)%numberVertices];

                //add chemical inversely proportional to cycle length
                deposit[u][v] = deposit[u][v] + depositAmount/pathLength;
                deposit[v][u] = deposit[u][v];
            }
        } 

        //update chemicals on edges by decaying and depositing 
        for (int i = 0; i < numberVertices; i++)
            for (int j = 0; j < numberVertices; j++)
                chemical[i][j] = chemical[i][j] - decayRate*chemical[i][j] + deposit[i][j];    
    } 

    //Method displays the best cycle found and its cost
    private void bestSolution(String outFile, int seed) throws IOException
    {
        //Create new print writer
        PrintWriter outWriter =  new PrintWriter(new FileWriter(outFile, true));

        outWriter.print("Best path: ");
        //print from first to last vertex, adjusted for 1 indexing
        for (int i = 0; i < numberVertices; i++)
            outWriter.print((solution[i]+1) + " ");

        //print first vertex, adjusted for 1 indexing
        outWriter.print((solution[0]+1));

        //print length
        outWriter.println("\nTotal length: " + length(solution));

        //print iterations
        outWriter.println("Total iterations: " + numberIterations);

        //print distance exponent
        outWriter.println("Distance exponent: " + distanceExponent);

        //print chemical exponent
        outWriter.println("Chemical exponent: " + chemicalExponent);

        //print initial deposit
        outWriter.println("Initial deposit: " + initialDeposit);

        //print deposit constant
        outWriter.println("Deposit constant: " + depositAmount);

        //print decay rate
        outWriter.println("Decay rate: " + decayRate);

        //print seed
        outWriter.println("Seed: " + seed);

        //close print writer
        outWriter.close();
    }
 
    //Method finds the length of a cycle
    private int length(int[] cycle)
    {
        int sum = 0;

        //add the weights of edges in the cycle
        for (int i = 0; i < numberVertices; i++)
            sum = sum + matrix[cycle[i]][cycle[(i+1)%numberVertices]];

        return sum;
    }
}