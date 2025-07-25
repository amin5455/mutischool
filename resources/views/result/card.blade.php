@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $student->name }} - {{ $exam->name }}</h3>
    <table class="table table-bordered">
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
    <a href="{{ route('result.pdf', [$student->id, $exam->id]) }}" class="btn btn-primary">Download PDF</a>
</div>
@endsection
