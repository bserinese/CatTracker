<html>
  <body>
    <BR>
    <pre class="ip-ubbcode-code-pre">
      <?php
        
        // Written 03/2024 PCF 

        // The function below is used to pull the last $lines of a file. 

        function tailFile($filepath, $lines = 1) {
          return trim(implode("", array_slice(file($filepath), -$lines)));
        }
                
        // Open the text file for writing out the data in append mode 
        $fh=fopen('./lunadata.txt','a');

        if ($_REQUEST['event'] == 'up') { 

          // Capture the body of POST
          $body = file_get_contents('php://input');
          
          // Select and store in a var the Date and Time out of the Body 
          $eventtime = $body;
          $eventtime = substr($eventtime,strpos($eventtime,"\"time\"")+8,19);
         
          // Select and store in a var the Sending Device Name - Used for Debugging 
          $eventdeviceName = $body; 
          $eventdeviceName = substr($eventdeviceName,strpos($eventdeviceName,"\"deviceName\"")+14,50);
          $eventdeviceName = substr($eventdeviceName,0,strpos($eventdeviceName,"\""));
          
          // Lat and Lon are stored in the Body / data as Base64 Data 
          // Select and store in a var data and decode it. 

          $eventdata = $body; 
          $eventdata = substr($eventdata,strpos($eventdata,"\"data\"")+8,50);
          $eventdata = substr($eventdata,0,strpos($eventdata,"\""));
          
          // Uncomment this line if you want to see the data field before the decode
          // fwrite($fh, $eventdata . ",\n");

          $eventdata = base64_decode($eventdata);
          
          // Uncomment this line if you want to see the data field after the decode
          // fwrite($fh, $eventdata . ",\n");

          // Uncomment this line if you want to dump all the data being sent to the file. 
          // fwrite($fh, $body . "\n");

          // fwrite($fh, $eventtime . " " . $eventdeviceName. " " . $eventdata . "\n");
         
          
          // Shorten the Date/Time to just time hh:mm 
          $eventtime = substr($eventtime,11,5);
          $lat = substr($eventdata, 0,strpos($eventdata,","));
          $lon = substr($eventdata, strpos($eventdata,",")+1,20);

          // This section writes out the data to the .txt file 
          // start with a ',' and newline. 
          // This is done this way becasue the last element in the jSON file does not have a ','
          
          fwrite($fh, ",\n");                               // write ',' and a new line 
          
          fwrite($fh, "{ \"time\": ");                      // write time to file 
          fwrite($fh, "\"" . $eventtime . "\", ");

          fwrite($fh, "\"latitude\": ");                    // write lat to file 
          fwrite($fh, $lat . ", ");

          fwrite($fh, "\"longitude\": ");                   // write lon to file 
          fwrite($fh, $lon);
     
          fwrite($fh, " }");                                // write footers 
         
          fclose($fh);                                      // close file 

          // This settion creates the JSON File 

          $fh=fopen('./lunadata.txt','r');                  // Open .txt file in read mode
          $fhjson=fopen('./locations.json','w');                 // Open .json file in write mode, overwrite from beginning. 


          fwrite($fhjson, "{ \"points\":[\n");              // write headers 
          
          fwrite($fhjson, tailFile('./lunadata.txt',25));   // write the last 25 data repots 

          fwrite($fhjson, "]}\n");                          // write footers 


          fclose($fhjson);                                  // close the file

        } else {
          // Uncomment this line if you want to see non Up events
          // fwrite($fh, "Non up event\n");
        }

        fclose($fh);
      ?>
    </pre>
  </body>
</html>
