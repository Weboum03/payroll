<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Salary Report</title>
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

    <table>
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Basic Salary</th>
                <th>Allowances</th>
                <th>Deductions</th>
                <th>Net Salary</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($users as $user)
            <tr>
                <td>{{ $user->employee_id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->payrollSingle->salary }}</td>
                <td>{{ $user->payrollSingle->gross_wages - $user->payrollSingle->salary }}</td>
                <td>{{ $user->payrollSingle->deduction }}</td>
                <td>{{ $user->payrollSingle->payout }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>