<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Exam;


use Illuminate\Http\Request;

class SchoolController extends Controller
{
        public function index()
    {
           $schools = School::all();
           return view('superadmin.dashboard', compact('schools'));
    }


        public function adminDashboard()
{
       $schoolId = auth()->user()->school_id;

    // --- Core stats (what you asked for) ---------------------------------
        $stats = [
            'totalStudents' => Student::where('school_id', $schoolId)->count(),
            'totalTeachers' => Teacher::where('school_id', $schoolId)->count(),
            'totalClasses'  => SchoolClass::where('school_id', $schoolId)->count(),
            'totalSubjects' => Subject::where('school_id', $schoolId)->count(),
            'presentCount'  => Attendance::where('school_id', $schoolId)
                                ->whereDate('date', today())
                                ->where('status', 'Present')->count(),
            'absentCount'   => Attendance::where('school_id', $schoolId)
                                ->whereDate('date', today())
                                ->where('status', 'Absent')->count(),
            'upcomingExams' => Exam::where('school_id', $schoolId)
                                ->where('start_date', '>=', today())
                                ->orderBy('start_date')
                                ->take(5)->get(),
        ];

        // --- Charts: Students growth (last 6 months) -------------------------
        $months = collect(range(5, 0))->map(function ($i) {
            return now()->startOfMonth()->subMonths($i);
        });

        $studentsSeries = $months->map(function ($month) use ($schoolId) {
            return Student::where('school_id', $schoolId)
                ->whereBetween('created_at', [$month->copy(), $month->copy()->endOfMonth()])
                ->count();
        });

        $monthLabels = $months->map(fn ($m) => $m->format('M Y'));

        // --- Charts: Attendance last 7 days (Present vs Absent) --------------
        $days = collect(range(6, 0))->map(fn ($i) => now()->subDays($i)->startOfDay());
        $attPresent = [];
        $attAbsent  = [];
        $dayLabels  = [];
        foreach ($days as $d) {
            $dayLabels[] = $d->format('d M');
            $attPresent[] = Attendance::where('school_id', $schoolId)
                ->whereDate('date', $d)
                ->where('status', 'Present')
                ->count();
            $attAbsent[]  = Attendance::where('school_id', $schoolId)
                ->whereDate('date', $d)
                ->where('status', 'Absent')
                ->count();
        }

        return view('dashboard', array_merge($stats, [
            'studentsSeries' => $studentsSeries,
            'monthLabels'    => $monthLabels,
            'attPresent'     => $attPresent,
            'attAbsent'      => $attAbsent,
            'dayLabels'      => $dayLabels,
        ]));
    }
    

public function schoolPage($id = null)
{
    return view('schools.create', ['id' => $id]);
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'user_id' => 'required|exists:users,id', // Make sure user_id is validated
    ]);

    // Step 1: Create the school
    $school = School::create($request->only(['name', 'email', 'phone', 'address']));

    // Step 2: Update user's school_id
    $user = User::find($request->user_id);
    $user->school_id = $school->id;
    $user->save();

    // Step 3: Redirect with message
    // $schools = School::all();
   return view('auth.login');
}

}
