# gambit-callenge
## Web app presenting TUF-2000M  data

Gambit are in the possession of a TUF-2000M ultrasonic energy meter, with a Modubus interface, witch is providing a live data feed to e website. This project is an answer to the Gambit Challenge, fetching the TUF-2000 data, parsing, converting and presenting it in a human readable format.
I have chosen "Option 2: Web or native app" to complete this task and created a web app hosted on a Amazon Web Service AWS.
The project is implemented using PHP, JavaScript/jQuery and CSS. PHP is the back bone of the project, doing all the heavy lifting such as parsing and converting the data in the back end and providing the actual web page. The information is moved between the back and frontend with JavaScript/jQuery and Ajax functions. The data fetched this way is then presented in a clear, easily readable table. The visualization, i.e. the looks, of the table is governed by CSS
The web app itself is hosted on a Amazon AWS server.
The project consists of a PHP backend simply called “backend.php” and a frontend webpage called “index.php.”
The flow is as follows: when the web page is loaded it sends a request to the backend through ajax, requesting the TUF-2000 data. The backend receives the request fetches the data and begins to parse and convert it with the aid of different conversion helper functions. And deposits the parsed data in an array witch is JSON-encoded and sent back to the frontend. In the front end the received data is looped through and used to build a table which is presented to the user.
This process is can also be manually triggered by clicking the "Fetch data" button on the webpage.

A link to the demo can be found below:
http://tuf-2000m-challenge.us-west-2.elasticbeanstalk.com/

## Future improvements

### User interface
The presentations of the data could be improved upon by further visualization. This could include graphical meters and graphs depending on the data being presented. For example a "dial meter" could be used for temperature monitoring. Different graphs could be used for flow etc. to this end Google graphs js package could be utilized. The fetching of the data could also be automated to update the table ever X-seconds. If need be the update interval could be user changeable by for example entering a update interval, in seconds, in a textbox. Or the page itself might provide a set of predefined update intervals to choose from, define by either radio buttons or perhaps a slider.

### Warning system
The backend could be fitted with warning systems. For example if a temperature where to reach a pre-set warning level, or any of the other measurements, the system could be set to send mails or some form of messages to a administrator. This could also be visualized in the frontend by turning the table value background to orange and red for the anomalous reading.

### DB integration
In order to store measurements in the long term some form of DB-integration storage could be used. The data could be stored in a database table at a pre-set interval. This could then be used to show historical data and create statistics reports.
