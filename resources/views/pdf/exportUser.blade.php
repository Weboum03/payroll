<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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
    <h1>Users</h1>

    <table>
        <thead>
            <tr>
            @foreach($heading as $value)
                <th>{{ $value }}</th>
            @endforeach
            </tr>
            
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                @foreach($params as $param)
                    <td>{{ $user[$param] }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>