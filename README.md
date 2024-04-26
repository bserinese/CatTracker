Welcome to the GPS/LoRa Cat Tracker for the ChirpStack LoRaWAN project.

Build your own GPS Cat Tracker as seen in Make Magazine!

This project uses the Heltec CubeCell GPS/LoRa module to send the GPS coordinates via LoRa to the ChirpStack LoRaWAN network server. 
The LoRaWAN Gateways are built on a Raspberry Pi using a Seeed Studio Wio-WM1302 LoRaWAN Gateway Module. 
Once the data is collected, a PHP script grabs the data payload from ChirpStack and then sends the parsed time and coordinate data to a JSON file, where a JavaScript from Leaflet produces markers on an OpenStreetMap map hosted on a simple web page at www.serinese.com/luna.

