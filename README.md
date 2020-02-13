# gambit-callenge
Web app presenting TUF-2000M  data

Gambit are in the posession of a TUF-2000M ultrasonic energy meter, with a Modubus interface, wicht is providing a live data feed to e website. This project is an answer to the Gambit Challenge, fetching the TUF-2000 data, parsinging, converting and presenting it in a human readable format. 

I have chosen "Option 2: Web or nativ app" to complete this task and created a web app hosted on a Amazon Web Service AWS.

The project is implemented using using PHP, javascriopt/jquery and css. PHP is the back bone of the project, doing all the heavy lifting such as parsing and converting the data in the back end and prviding the actual web page. The information is moved between the back and frontend with javascript/jquery and ajax functions. The data fetched yhis way is then presented in a clear, easaly readable table. Teh visluaization, the looks, of the table is governed by CSS

The web app itself is hostend on a Amazon AWS server configured with elastik beanstalk.

The project consists of a PHP backend simply called backend.php and a frontend webpage called main.php.

The flow is as followes. when teh web page is loaded it sends a request to the packend through ajax, requesting the TUF-2000 data. The backend receives the request fetches the data and begins to parse and convert it wioth the the aid of differnte conversion helper functions. And deposits the parsed data in a array witch is JSON-encoded and sent back to the frontend. In the frpnt end the received data is looped through and used to build a inforation table wich is presented to the user.

This process is can also be manually triggerd by clicking the "Fetch data" button on the webpage.


## Future improwments

### User interface
The presentations of teh data could be improved upon by furhter visulaization meens. This could include graphical meters and grapchs depending on the data beeing presented. For example a "dial meter" couldbe used for temperature monitoring. Different grapch sould be used for flow etc. to this end Google grapsh js package cpuld be utelized. The fetchig of the data could also be auomtaed to uipdate the table ever X-seconds. If need be the update intervall could be user cahgable by for example entering a update intervall in seconds in a textbox or the GUI might provide a set of predefined updete intervall to choose from by radio buttens or perhaps a slider.

### Warning system
The backend could be fitted with warning systems. For example if a temperature where to reach a preset warning levele, or any of he other measuremets, the system caoud be set to send mails or some form of messages to a administrator. This could also be visulaized in the frontend by turning the table value backgrodun to roange and red for the anomalous reading.

### DB integration
In order to store measurments in the long teerm some form of DB-integraton storage could be used. Te data could be stored in a database table at a preset interall. This could then be used to show historaical data and create statistiks reports.
