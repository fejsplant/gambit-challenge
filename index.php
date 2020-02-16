
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<!-- Loading "Spinner when fetching and parsing data, modal"-->
<div id="loadingModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id='loader' style="text-align: center">
            <h4>Loading pleas wait</h4>
            <img src='idle_gambit.gif' >
        </div>
    </div>
</div>


<!doctype html>
    <html lang="en">
        <body>
            <div style="text-align:center; margin-top:40px; ">
                <h1>TUF-2000M Readouts <div id ="readDate"><div> </h1>
                <h2><div id ="dataDateDiv"><div> </h2>
                <button onclick="createTable()" class="btn btn-primary" style="margin-bottom: 10px;">
                    Get data
                </button>
            </div>

            <div class="container table-responsive" >
                <table id="table1"  class="table table-hover table-condensed table-striped table-sm table-bordered  " >
                    <tr>
                        <th>Name</th>
                        <th>Converted value</th>
                        <th>Unit</th>
                        <th>Register</th>
                        <th>Original (high/low)</th>
                        <th>Format</th>
                    </tr>
                 </table>
            </div>
        </body>
    </html>


<script>
    /*Creates table on page load*/
    $(document).ready(function() {
        createTable();
    });

/*Main worker. Presents loader, fetches daa from backend. On success shows,
*removes loader and creates new table with data
* */
    function createTable() {
        $.ajax({
            type: 'POST',
            //Develop Url
            // url: "http://localhost/backend.php",
            /*OBS production url*/
            url: "https://g-challenge.000webhostapp.com/backend.php",
            data: {'callFunction': 'createTable'},
            dataType: 'json',

            beforeSend: function(){
                $("#loadingModal").show();
            },
            success: function (data) {

                $('#table1').find('tbody').empty();
                $('<tr>').append(
                    $('<th>').text("Register/s"),
                    $('<th>').text("Description"),
                    $('<th>').text("Value"),
                    $('<th>').text("Unit"),
                    $('<th>').text("Original Low/high"),
                    $('<th>').text("format"),
                ).appendTo('#table1');

                var date = data['date'];
                delete data['date'];

                $('#dataDateDiv').html(date);

                $.each(data, function (i, item) {
                    var $tr = $('<tr>').append(
                        $('<td>').text(item.regs),
                        $('<td>').text(item.name),
                        $('<td>').text(item.converted),
                        $('<td>').text(item.unit),
                        $('<td>').text(item.orig),
                        $('<td>').text(item.format),
                    ).appendTo('#table1');
                    // console.log($tr.wrap('<p>').html());
                });
            },
            complete:function(data){
                $("#loadingModal").hide();
            }
        });
    }
    /*Automated table update, not in use*/
    // var interval = 1000;  // 1000 = 1 second, 3000 = 3 seconds
    //  setTimeout(createTable, interval);


    /*test function for rawdata*/
    function getRawData() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/backend.php",
            data:{'callFunction':'getRawData'},
            dataType: 'json',
            success: function (data) {

                console.log("success   ");
                console.log(data);
            },
            complete: function (data) {
                // Schedule the next
                //  setTimeout(doAjax, interval);
                console.log("in complete");
                console.log(data);
            }
        });
    }


    /*test function for flowrate*/
    function getFlowRate() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/backend.php",
            data:{'callFunction':'getFlowRate'},
            dataType: 'json',
            success: function (data) {
                $("#flowRateData").html(data);
            },
            complete: function (data) {
                // console.log("in completedd");
                // console.log(data);
            }
        });
    }

</script>

<style>
    /*table {*/
    /*    border-collapse: collapse;*/
    /*    width: 100%;*/
    /*}*/

    /*th, td {*/
    /*    padding: 8px;*/
    /*    text-align: left;*/
    /*    border-bottom: 1px solid #ddd;*/
    /*}*/



    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */

    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

</style>

