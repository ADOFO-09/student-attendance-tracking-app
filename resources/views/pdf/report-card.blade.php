<!DOCTYPE html>
<html>
<head>
    <title>Report Card</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Report Card</h2>
    <p><strong>Student:</strong> {{ $student->first_name }} {{ $student->last_name }}</p>
    <p><strong>Term:</strong> {{ $term }}</p>

    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Final Score (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result['subject'] }}</td>
                    <td>{{ $result['score'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
