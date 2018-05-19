
package logsaver; 

import java.io.*;
import java.lang.*;
import java.util.*;
import java.applet.*;

/**
 * logsave
 */
class save  {

    public void log(String a)
    {
        BufferedWriter writer = null;
        try
        {
        
            writer = new BufferedWriter( new FileWriter( "Logs/Speed.txt"));
            writer.write( a);
        
        }
        catch ( IOException e)
        {
        }
        finally
        {
            try
            {
                if ( writer != null)
                writer.close( );
            }
            catch ( IOException e)
            {
            }
        }
    }
}

public class logsave extends save {
    public void loger(String a)
    {
        String b = a;

        save z = new save();
        z.log(b);

    }
}