<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report Card</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; }
    </style>
</head>
<body>
    <h2>{{ $student->name }} - {{ $exam->name }} Report Card</h2>
    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Total Marks</th>
                <th>Obtained Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marks as $mark)
                <tr>
                    <td>{{ $mark->examSubject->subject->name }}</td>
                    <td>{{ $mark->examSubject->total_marks }}</td>
                    <td>{{ $mark->obtained_marks }}</td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                <td>{{ $result['total_marks'] }}</td>
                <td>{{ $result['total_obtained'] }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Percentage</strong></td>
                <td>{{ $result['percentage'] }}%</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Grade</strong></td>
                <td>{{ $result['grade'] }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
