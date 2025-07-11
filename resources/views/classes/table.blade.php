<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Class Name</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($classes as $index => $class)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $class->name }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">No classes found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
