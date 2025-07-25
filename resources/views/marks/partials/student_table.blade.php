<table class="table table-bordered">
    <thead>
        <tr>
            <th>Student</th>
            <th>Marks</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>
                <input type="number" data-id="{{ $student->id }}" class="form-control student-mark" step="0.01" min="0" required>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
