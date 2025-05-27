/*Jacob Yankee
 * COSC 461
 * Maniccam
 * Homework 1
 */
//Tester program for sliding board solver with best first search
import java.io.*;
import java.util.*;

public class SlidingBestTester
{
    //main method for testing
    public static void main(String[] args)
    {   
        Scanner scan = new Scanner(System.in);
        System.out.println("Enter the input file:");
        String input = scan.nextLine();
        System.out.println("Enter the output file:");
        String output = scan.nextLine();

        try
        {
            File inputF = new File(input);
            Scanner scanF = new Scanner(inputF);

            int size = scanF.nextInt();
            int[][] initial = new int[size][size];

            //Convert R and G values to -1 and -2 so int array can be used over char array
            for(int i = 0; i < size; i++)
            {
                for(int j = 0; j < size; j++)
                {
                    String val = scanF.next();

                    if(val.equals("R"))
                    {
                        initial[i][j] = -1;
                    }
                    else if(val.equals("G"))
                    {
                        initial[i][j] = -2;
                    }
                    else
                    {
                        initial[i][j] = Integer.parseInt(val);
                    }
                }
            }

            scanF.close();

            SlidingBest s = new SlidingBest(initial, size, output);
            s.solve();
        }
        catch (Exception e)
        {
            System.out.println(e.getMessage());
        }
        finally
        {
            scan.close();
        }
    }
}

 