<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Salary Transfer Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header, .footer {
            text-align: center;
        }
        .content {
            margin-top: 20px;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Payroll</h1>
        <p>123 Business St, Cityville</p>
    </div>

    <div class="content">
        <p>Date: {{ date('Y-m-d') }}</p>
        <p>To,</p>
        <p>The Branch Manager,<br>
        SBI Bank<br>
        Branch<br></p>

        <p>Dear Sir/Madam,</p>

        <p>We hereby authorize you to transfer the salaries for the month of June to the respective bank accounts of our employees as per the details provided below:</p>
        
        <div class="table-container">
            <table>
                <thead>
                
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Account Number</th>
                        <th>Bank Name</th>
                        <th>Net Salary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->employee_id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p>Thank you for your assistance in this matter.</p>

        <p>Sincerely,</p>
        <p>Name<br>
        Payroll Corporation</p>
    </div>

    <div class="footer">
        <p></p>
    </div>

</body>
</html>