<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Attendance Report</title>
    <style>
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
    <h1>Payroll</h1>
    <p>Location: ----</p>
    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Days Present</th>
                <th>Days Absent</th>
                <th>Total Working Days</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)   
            <tr>
                <td>{{ $user->employee_id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->payrollSingle?->working_days - $user->payrollSingle?->loss_pay_days }}</td>
                <td>{{ $user->payrollSingle?->loss_pay_days }}</td>
                <td>{{ $user->payrollSingle?->working_days }}</td>
            </tr>
        @endforeach 
        </tbody>
    </table>
</body>
</html>