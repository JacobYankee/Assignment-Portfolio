/* Jacob Yankee
 * Maniccam
 * COSC 461
 * Homework 2
 */
import java.io.*;
import java.util.*;

//Program tests k-means clustering in a specific application
public class KmeansTester
{
    //Main method
    public static void main(String[] args) throws IOException
    {
        Scanner scan = new Scanner(System.in);

        System.out.println("Please enter the file path to the input file: ");
        String inF = scan.nextLine();

        System.out.println("please enter the file path to the output file: ");
        String outF = scan.nextLine();


        //create clustering object
        Kmeans k = new Kmeans();

        //load records
        k.load(inF);

        //set parameters
        k.setParameters(4, 10000, 58947);

        //perform clustering
        k.cluster();
        
        //display records and clusters
        k.display(outF);

        scan.close();
    }
}
