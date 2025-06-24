<!DOCTYPE html>
<html>
<head>
    <title>Performance Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <h2>Performance Report - Grade {{ $grade->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Exercises</th>
                <th>Average (%)</th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $student)
                <tr>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['count'] }}</td>
                    <td>{{ $student['average'] }}%</td>
                    <td>{{ $student['rating'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
