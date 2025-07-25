@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">All Class Timetables</h2>

    @foreach ($classes as $class)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <span>Class: {{ $class->name }}</span>
                <a href="{{ route('timetables.print.class', $class->id) }}" target="_blank" class="btn btn-sm btn-primary">🖨️ Print Timetable</a>
            </div>
            <div class="card-body">
                @if($class->timetables->count())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Start</th>
                                <th>End</th>
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
                @else
                    <p>No timetable found for this class.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
