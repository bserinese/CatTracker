The files listed are required to run on a webserver in order to display the GPS coordinates from the ChirpStack LoRaWAN Cat Tracker application onto a webpage with an OpenStreetMap map.
You can change the image for the marker pins on the map by changing the cat.png file.
The cat.ico is the optional icon file used on the browser and the LunaSM.jpg is a pretty picture for the title.

To install the web page, copy all of these files in the same folder on your web server.
You will need to change the permissions on the savedata.php file so it can be Executed.
My host has a graphical file manager that allows me to set the permissions so Owner, Group, and Public has Execute permissions. That translates to 755 or -rwxr-xr-x if you are old school.

The first time savedata.php receives data from the ChirpStack.io application, it will create a file called lunadata.txt. This is a log file that will continually store all of the GPS data that comes from ChirpStack. The savedata.php will pull the last 25 data points from this log file and append it to the locations.json file. The leafletscript.js uses the locations.json to display the marker pins on the OpenStreeMap map on the webpage.
Before it will run properly, you will need to make a minor edit to the initial lunadata.txt file.
Open the luandata.txt file and delete the comma found on the first line:

	,  
	{ "time": "17:13", "latitude": 44.44418, "longitude": -73.05936 }, 

Once deleted, it will not come back and you will not need to bother with the file again.
Another quirk of the savedata.php file is that it displays the raw time from ChirpStack in UTC. I'm still trying to figure out how to make ChirpStack produce Eastern time for me.
