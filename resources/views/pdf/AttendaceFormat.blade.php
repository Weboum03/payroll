<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            font-size: 12px;
            width: 70%;
            border-collapse: collapse;
        }

        .tables-left-up table{
            width: 25vw;
        }
        .tables-left-up table td:nth-of-type(1){
            font-weight: 500;
        }

        th,
        td {
          
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #cee310;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td:nth-child(1) {
            background-color: #cee310;
            display: flex;
        }

        tr:hover {
            background-color: #f1f1f1;
        }


        .navbar {
            display: flex;
            align-items: center;
            justify-content: center;

            height: 200px;
        }

        .navbar-items {
            padding: 10px 20px;
            gap: 40px;
            height: 150px;
            display: flex;
            justify-content: space-between;
        }

        .navbar-items-item {

            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1px;
            text-align: center;
        }

        .navbar-items-item p {
            font-size: 16px;
            font-weight: 600;
        }

        .box {
            height: 40px;
            width: 100px;
            background-color: rgb(11, 215, 215);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid black;
            font-size: 30px;
            font-weight: 700;
            border-radius: 4px;
        }

        span {
            font-weight: 900;
            color: blue;
        }

        .tables {
            display: flex;
            gap: 20px;

        }

         .notes {
            border: 1px solid black;
            display: flex;
            justify-content: center;
            margin-top: 30px;
            flex-direction: column;
        } 

        .notes-heading {
          text-align: center;
            text-transform: uppercase;
            font-size: 15px;
            font-weight: 600;

            background-color: #cee310;
        }

        .notes textarea {
            font-size: 12px;
            font-weight: 400;
            font-family: sans-serif;
            font-size: 15px;
            overflow: hidden;
            outline: none;
            border: none;
        } 

        .clockify {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            color: violet;
        }
    </style>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>

    <div class="container">
    <div class="navbar">
        <div class="navbar-items">
            <div class="navbar-items-item">
                <p>create and insert for employees who <span>attended</span></p>
                <div class="box">
                    <i class="fa-solid fa-check"></i>
                </div>
            </div>
            <div class="navbar-items-item">
                <p>create and insert for employees who were on <span>sick leave</span></p>
                <div class="box" style="background-color: violet;">
                    S
                </div>
            </div>
            <div class="navbar-items-item">
                <p>create and insert for employees who were on <span>personal</span></p>
                <div class="box" style="background-color: orange;">
                    P
                </div>
            </div>
            <div class="navbar-items-item">
                <p>create and insert for employees who were on <span>Vacation</span></p>
                <div class="box" style="background-color: rgb(237, 111, 111);">
                    V
                </div>
            </div>
            <div class="navbar-items-item">
                <p>create and insert for employees who <span>neither showed nor called</span></p>
                <div class="box" style="background-color: rgba(110, 101, 101, 0.678);">
                    C
                </div>
            </div>
        </div>
    </div>

    <div class="tables">
        <table border="1px">
            <thead>
                <tr>
                    <th>[INSERT DATE]</th>
                    <th>[ATTENDENCE STATUS]</th>
                    <th>[CHECK-IN-TIME]</th>
                    <th>[CHECK-OUT-TIME]</th>
                    <th>[TOTAL BREAK TIME]</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p class="d-flex flex-column" style="margin-bottom: 0px;">
                            <span>Employee 1 :[insert name]</span>
                            <span>position :[insert position]</span>
                            <span>Department:[insert Department]</span>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <p class="d-flex flex-column" style="margin-bottom: 0px;">
                            <span>Employee 2 :[insert name]</span>
                            <span>position :[insert position]</span>
                            <span>Department:[insert Department]</span>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <p class="d-flex flex-column" style="margin-bottom: 0px;">
                            <span>Employee 3 :[insert name]</span>
                            <span>position :[insert position]</span>
                            <span>Department:[insert Department]</span>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <p class="d-flex flex-column" style="margin-bottom: 0px;">
                            <span>Employee 4 :[insert name]</span>
                            <span>position :[insert position]</span>
                            <span>Department:[insert Department]</span>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <p class="d-flex flex-column" style="margin-bottom: 0px;">
                            <span>Employee 5 :[insert name]</span>
                            <span>position :[insert position]</span>
                            <span>Department:[insert Department]</span>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <p class="d-flex flex-column" style="margin-bottom: 0px;">
                            <span>Employee 6 :[insert name]</span>
                            <span>position :[insert position]</span>
                            <span>Department:[insert Department]</span>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <p class="d-flex flex-column" style="margin-bottom: 0px;">
                            <span>Employee 7 :[insert name]</span>
                            <span>position :[insert position]</span>
                            <span>Department:[insert Department]</span>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        
        <div class="tables-left">
            <div class="tables-left-up">
                <table border="1px">
                    <thead>
                        <tr>
                            <th colspan="2">DAILY STATISTIC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Attended</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Total Sick leave</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Total Personal leave</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Total Vacation leave</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Total no show no call</td>
                            <td>0</td>
                        </tr>
                        <tr>
                            <td>Total break time</td>
                            <td>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="notes">
                <div class="notes-heading">
                    Notes
                </div>
                <textarea rows="6" cols="41" placeholder="enter your notes here"></textarea>
            </div>
        </div>

    </div>

</div>

    


    <script src="https://kit.fontawesome.com/cd0ffee7a9.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>

</html>