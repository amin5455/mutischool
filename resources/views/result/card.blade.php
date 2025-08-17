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
    @php
        $examSubject = \App\Models\ExamSubject::where('exam_id', $exam_id)
            ->where('school_class_id', $student->class_id)
            ->where('subject_id', $mark->subject_id)
            ->first();
    @endphp
    <tr>
        <td>{{ $mark->subject->name ?? 'N/A' }}</td>
        <td>{{ $examSubject->total_marks ?? 'N/A' }}</td>
        <td>{{ $mark->marks_obtained }}</td>
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
    <a href="{{ route('result.pdf', [$student->id, $exam->id]) }}" class="btn btn-primary disabled">Download PDF</a>
</div>
@endsection
