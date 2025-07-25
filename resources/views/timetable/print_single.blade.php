<!DOCTYPE html>
<html>
<head>
    <title>Class Timetable - {{ $class->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <h2>Class Timetable - {{ $class->name }}</h2>
    <button onclick="window.print()" class="no-print" style="margin-bottom: 10px;">🖨️ Print</button>
    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Subject</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            @foreach($class->timetables as $tt)
                <tr>
                    <td>{{ ucfirst($tt->weekday) }}</td>
                    <td>{{ $tt->start_time }}</td>
                    <td>{{ $tt->end_time }}</td>
                    <td>{{ $tt->subject->name ?? 'N/A' }}</td>
                    <td>{{ $tt->teacher->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
