@extends('layouts.app')

@section('content')
<div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📊 Dashboard</h2>
        <span class="text-muted">Welcome back, {{ Auth::user()->name }}</span>
    </div>
    <!-- Metric Cards -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card card-soft p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Total Students</div>
                        <div class="metric text-primary">{{ $totalStudents }}</div>
                    </div>
                    <div class="display-6 text-primary"><i class="fa-solid fa-user-graduate"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card card-soft p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Total Teachers</div>
                        <div class="metric text-success">{{ $totalTeachers }}</div>
                    </div>
                    <div class="display-6 text-success"><i class="fa-solid fa-person-chalkboard"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card card-soft p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Total Classes</div>
                        <div class="metric text-warning">{{ $totalClasses }}</div>
                    </div>
                    <div class="display-6 text-warning"><i class="fa-solid fa-building-columns"></i></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card card-soft p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted">Total Subjects</div>
                        <div class="metric text-danger">{{ $totalSubjects }}</div>
                    </div>
                    <div class="display-6 text-danger"><i class="fa-solid fa-book"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Today + Quick Summary -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="card card-soft">
                <div class="card-body">
                    <h6 class="mb-3">Today's Attendance</h6>
                    <div class="row text-center">
                        <div class="col">
                            <div class="text-muted">Present</div>
                            <div class="fs-3 text-success fw-bold">{{ $presentCount }}</div>
                        </div>
                        <div class="col">
                            <div class="text-muted">Absent</div>
                            <div class="fs-3 text-danger fw-bold">{{ $absentCount }}</div>
                        </div>
                    </div>
                    <canvas id="attendance7Chart" height="130" class="mt-3"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card card-soft">
                <div class="card-body">
                    <h6 class="mb-3">Students Growth (6 months)</h6>
                    <canvas id="studentsGrowthChart" height="130"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Exams -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card card-soft">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Upcoming Exams</h6>
                        <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($upcomingExams as $exam)
                                    <tr>
                                        <td>{{ $exam->name }}</td>
                                        <td>{{ $exam->class->name ?? '—' }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($exam->start_date)->format('d M Y') }}</td>
                                        <td>{{ \Illuminate\Support\Carbon::parse($exam->end_date)->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted">No upcoming exams</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
  $(document).ready(function() {
    // ---- Data from PHP ----
const monthLabels   = @json($monthLabels);
const studentsSeries= @json($studentsSeries);
const dayLabels     = @json($dayLabels);
const attPresent    = @json($attPresent);
const attAbsent     = @json($attAbsent);

// ---- Students Growth (Line) ----
new Chart(document.getElementById('studentsGrowthChart'), {
    type: 'line',
    data: {
        labels: monthLabels,
        datasets: [{
            label: 'New Students',
            data: studentsSeries,
            borderWidth: 2,
            tension: .35,
            fill: false
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

// ---- Attendance Last 7 Days (Bar) ----
new Chart(document.getElementById('attendance7Chart'), {
    type: 'bar',
    data: {
        labels: dayLabels,
        datasets: [
            { label: 'Present', data: attPresent, backgroundColor: 'rgba(25, 135, 84, .7)' },
            { label: 'Absent',  data: attAbsent,  backgroundColor: 'rgba(220, 53, 69, .7)' }
        ]
    },
    options: {
        scales: { y: { beginAtZero: true } }
    }
});
  });
</script>
@endsection