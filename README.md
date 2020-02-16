# gambit-callenge
## Web app presenting TUF-2000M  data

Gambit are in the possession of a TUF-2000M ultrasonic energy meter, with a Modubus interface, which is providing a live data feed to a website. This project is an answer to the Gambit Challenge, fetching the TUF-2000 data, parsing, converting and presenting it in a human readable format.
I have chosen "Option 2: Web or native app" to complete this task and created a web app hosted on a 000webhost server.
The project is implemented using PHP, JavaScript/jQuery and CSS. PHP is the back bone of the project, doing all the heavy lifting such as parsing and converting the data in the back-end and providing the actual web page. The information is moved between the back- and front-end with JavaScript/jQuery and Ajax functions. The data fetched this way is then presented in a clear, easily readable table. The visualization, i.e. the looks, of the table is governed by CSS

The web app itself is hosted on a webhost app server.
https://www.000webhost.com/

The project consists of a PHP back-end simply called “backend.php” and a front-end webpage called “index.php.”
The flow is as follows: when the web page is loaded it sends a request to the back-end through ajax, requesting the TUF-2000 data. The back-end receives the request, fetches the data, and begins to parse and convert it with the aid of different conversion helper functions. After this, the parsed data is stored in an array, JSON-encoded, and sent back to the front-end. In the front-end the received data is looped through and used to build a table which is presented to the user.
This process can also be manually triggered by clicking the "Get data" button on the web page.

A link to the demo can be found below:
https://g-challenge.000webhostapp.com/

## Future improvements

### User interface
The presentation of the data could be improved upon by further visualization. This could include graphical meters and graphs depending on the data being presented. For example a "dial meter" could be used for temperature monitoring. Different graphs could be used for flow etc. To this end Google graphs js-package could be utilized. The fetching of the data could also be automated to update the table every X-seconds. If need be the update interval could be user changeable by for example entering a update interval, in seconds, in a text box. Or the page itself might provide a set of predefined update intervals to choose from, defined by either radio buttons or perhaps a slider.

### Warning system
The back-end could be fitted with warning systems. For example if a temperature were to reach a pre-set warning level, or any of the other measurements, the system could be set to send e-mails or some form of messages to an administrator. This could also be visualized in the front-end by turning the table value background to orange and red for the anomalous reading.

### DB integration
In order to store measurements in the long term, some form of database storage could be used. The data could be stored in a database table at a pre-set interval. This could then be used to show historical data and create statistical reports.
