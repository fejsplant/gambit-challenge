<?php header('Access-Control-Allow-Origin: *'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php


$jsonData = file_get_contents('http://tuftuf.gambitlabs.fi/feed.txt');


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $file = '/tmp/sample-app.log';
    $message = file_get_contents('php://input');
    file_put_contents($file, date('Y-m-d H:i:s') . " Received message: " . $message . "\n", FILE_APPEND);
}
else
{
    ?>
    <!doctype html>
    <html lang="en">

    <body>
    <section class="Beginning">
        <div style="text-align:center; margin-top:40px; ">
            <h1>TUF-2000M Readouts <div id ="readDate"><div> </h1>
            <button onclick="createTable()">
                createtable
            </button>
        </div>



    </section>


    <div class="table-wrapper">
    <table id="table1" class="fl-table"  >
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

    <!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
    </body>
    </html>
    <?php
}
?>

<script>

    function doAjax(){

        $("#box").load("http://tuftuf.gambitlabs.fi/feed.txt");
    }
    var interval = 1000;  // 1000 = 1 second, 3000 = 3 seconds
    function getRawData() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/backend.php",
            data:{'callFunction':'getRawData'},
            dataType: 'json',
            success: function (data) {

                console.log("success    ");
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


    function getFileDate() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/backend.php",
            data:{'callFunction':'getFileDate'},
            dataType: 'json',
            success: function (data) {

                console.log("success    ");
                 console.log(data);
                $("#readDate").html(data);
                // $('#readDate').innerText(data);
            },
            complete: function (data) {
                // Schedule the next
                //  setTimeout(doAjax, interval);
                console.log("in completedd");
                console.log(data);
            }
        });
    }

    function getFlowRate() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/backend.php",
            data:{'callFunction':'getFlowRate'},
            dataType: 'json',
            success: function (data) {

                $("#flowRateData").html(data);
                // $('#readDate').innerText(data);
            },
            complete: function (data) {
                // Schedule the next
                //  setTimeout(doAjax, interval);
                console.log("in completedd");
                console.log(data);
            }
        });
    }

    function createTable() {


        // console.log("in createtable");
        $.ajax({
            type: 'POST',
            url: "http://localhost/backend.php",
            data: {'callFunction': 'createTable'},
            dataType: 'json',
            success: function (data) {

                // console.log("in create table success");
                $('#table1').find('tbody').empty();
                $('<tr>').append(
                    $('<th>').text("Register/s"),
                    $('<th>').text("Description"),
                    $('<th>').text("Value"),
                    $('<th>').text("Unit"),
                    $('<th>').text("Original Low/high"),
                    $('<th>').text("format"),
                ).appendTo('#table1');


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


            complete: function (data) {
                // Schedule the next
                //  setTimeout(doAjax, interval);
                // console.log("in completedd");
                // console.log(data);
            }
        });

    }

    //  setTimeout(doAjax, interval);
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

    tr:hover {background-color:#f5f5f5;}




    {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    body{
        font-family: Helvetica;
        -webkit-font-smoothing: antialiased;
    <!--
    background: rgba( 71, 147, 227, 1);
    -->
    }
    h2{
        text-align: center;
        font-size: 18px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        padding: 30px 0;
    }

    /* Table Styles */

    .table-wrapper{
        margin: 10px 70px 70px;
        box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
    }

    .fl-table {
        border-radius: 5px;
        font-size: 12px;
        font-weight: normal;
        border: none;
        border-collapse: collapse;
        width: 100%;
        max-width: 100%;
        white-space: nowrap;
        background-color: white;
    }

    .fl-table td, .fl-table th {
        text-align: center;
        padding: 8px;
    }

    .fl-table td {
        border-right: 1px solid #f8f8f8;
        font-size: 12px;
    }

    .fl-table thead th {
        color: #ffffff;
        background: #4FC3A1;
    }


    .fl-table thead th:nth-child(odd) {
        color: #ffffff;
        background: #324960;
    }

    .fl-table tr:nth-child(even) {
        background: #F8F8F8;
    }

    /* Responsive */

    @media (max-width: 767px) {
        .fl-table {
            display: block;
            width: 100%;
        }
        .table-wrapper:before{
            content: "Scroll horizontally >";
            display: block;
            text-align: right;
            font-size: 11px;
            color: white;
            padding: 0 0 10px;
        }
        .fl-table thead, .fl-table tbody, .fl-table thead th {
            display: block;
        }
        .fl-table thead th:last-child{
            border-bottom: none;
        }
        .fl-table thead {
            float: left;
        }
        .fl-table tbody {
            width: auto;
            position: relative;
            overflow-x: auto;
        }
        .fl-table td, .fl-table th {
            padding: 20px .625em .625em .625em;
            height: 60px;
            vertical-align: middle;
            box-sizing: border-box;
            overflow-x: hidden;
            overflow-y: auto;
            width: 120px;
            font-size: 13px;
            text-overflow: ellipsis;
        }
        .fl-table thead th {
            text-align: left;
            border-bottom: 1px solid #f7f7f9;
        }
        .fl-table tbody tr {
            display: table-cell;
        }
        .fl-table tbody tr:nth-child(odd) {
            background: none;
        }
        .fl-table tr:nth-child(even) {
            background: transparent;
        }
        .fl-table tr td:nth-child(odd) {
            background: #F8F8F8;
            border-right: 1px solid #E6E4E4;
        }
        .fl-table tr td:nth-child(even) {
            border-right: 1px solid #E6E4E4;
        }
        .fl-table tbody td {
            display: block;
            text-align: center;
        }
    }



</style>

