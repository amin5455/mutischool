<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectTeacherController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\AttendanceController;
use App\Models\Section;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\ResultController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/login', function () {
    return view('auth.login');
})->middleware(['auth', 'verified'])->name('login');
Route::middleware(['auth', 'superadmin'])->group(function () {
   Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin');
     Route::post('/schools/{school}/toggle', [\App\Http\Controllers\SuperAdminController::class, 'toggleStatus'])->name('schools.toggle');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/schools/create', [SchoolController::class, 'create'])->name('schools.create');
    Route::post('/schools', [SchoolController::class, 'store'])->name('schools.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->middleware(['auth'])->name('users.index');
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
    Route::get('/sections', [SectionController::class, 'index'])->name('sections.index');
    Route::post('/sections', [SectionController::class, 'store'])->name('sections.store');
    Route::get('/sections/list', [SectionController::class, 'list'])->name('sections.list'); 
    Route::get('/sections/{id}/edit', [SectionController::class, 'edit']);
    Route::put('/sections/{section}', [SectionController::class, 'update'])->name('sections.update');
    Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name('sections.destroy');

    Route::resource('students', StudentController::class);
    Route::get('/students/list', [StudentController::class, 'show'])->name('students.list');
    Route::get('/sections-by-class/{class_id}', [StudentController::class, 'getSectionsByClass']);

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/fetch', [TeacherController::class, 'fetch'])->name('teachers.fetch');
    Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
    Route::put('/teachers/update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/delete/{id}', [TeacherController::class, 'destroy'])->name('teachers.delete');

    Route::resource('subjects', SubjectController::class)->except(['show']);
    Route::get('/get-subjects', [SubjectController::class, 'getSubjects'])->name('subjects.list');

    Route::get('/assign-subjects', [ClassSubjectTeacherController::class, 'index'])->name('assign.index');
    Route::get('/assign-subjects/list', [ClassSubjectTeacherController::class, 'list'])->name('assign.list');
    Route::post('/assign-subjects/store', [ClassSubjectTeacherController::class, 'store'])->name('assign.store');
    Route::delete('/assign-subjects/{id}', [ClassSubjectTeacherController::class, 'destroy'])->name('assign.destroy');

    Route::get('/timetable', [TimetableController::class, 'index'])->name('timetable.index');
    Route::post('/timetable/store', [TimetableController::class, 'store'])->name('timetable.store');
    Route::get('/timetable/list', [TimetableController::class, 'list'])->name('timetable.list');
    Route::delete('/timetable/{id}', [TimetableController::class, 'destroy'])->name('timetable.destroy');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/load-students', [AttendanceController::class, 'loadStudents'])->name('attendance.loadStudents');
    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');

    Route::get('/get-sections/{class_id}', [AttendanceController::class, 'getSectionsByClass']);

    Route::get('/timetables/print', [TimetableController::class, 'showAllTimetables'])->name('timetables.print');
    Route::get('/timetables/print/class/{id}', [TimetableController::class, 'printClassTimetable'])->name('timetables.print.class');

    Route::resource('exams', ExamController::class);
    Route::post('/exam-subjects', [ExamController::class, 'storeExamSubjects'])->name('exam.subjects.store');

    Route::get('/marks-entry', [MarksController::class, 'index'])->name('marks.index');
    Route::post('/marks-entry/fetch-students', [MarksController::class, 'fetchStudents']);
    Route::post('/marks-store', [MarksController::class, 'store'])->name('marks.store');
    
   Route::get('/exam-results', [ResultController::class, 'studentList'])->name('results.index');
    Route::get('/student-result/{student_id}/{exam_id}', [ResultController::class, 'show'])->name('result.show');
    Route::get('/student-result/pdf/{student_id}/{exam_id}', [ResultController::class, 'downloadPdf'])->name('result.pdf');

});


// Route::middleware(['auth', 'superadmin'])->group(function () {
//     Route::get('/superadmin-dashboard', function () {
//         return view('superadmin.dashboard');
//     })->name('superadmin.dashboard');
// });


require __DIR__.'/auth.php';
