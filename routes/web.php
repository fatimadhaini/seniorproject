<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\DisabilityController;
use App\Http\Controllers\SignController; 
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\GradeController;
use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BrailleController;
use App\Http\Controllers\EventController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaceDescriptorController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExamController;
use App\Exports\StudentsExport;
use App\Http\Controllers\NotificationController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ParentDashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
*/



Route::get('/', function () {
    return view('client.index');
});
Route::get('/face/register', function () {
    return view('face.register');
});
Route::get('/assistant', function () {
    return view('assistant');
})->name('assistant');


Route::post('/face/save-descriptor', [FaceDescriptorController::class, 'store']);

Route::get('/apply', [GradeController::class, 'showApplyForm'])->name('apply');
Route::post('/applications/store', [ApplicationController::class, 'store'])->name('application.store');

Route::get('/one-step-left', function () {
    return view('client.one-step-left');
})->name('one-step-left');


Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


// Authentication Routes
Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');
Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
   
    Route::get('/chat/{receiverId?}', [MessageController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [MessageController::class, 'send'])->name('chat.send');
    Route::get('/chat/fetch/{receiver}', [MessageController::class, 'fetch'])->name('chat.fetch');
    // routes/web.php
    Route::post('/chat/typing', [MessageController::class, 'typing'])->name('chat.typing');
    Route::get('/chat/typing-status/{receiver}', [MessageController::class, 'typingStatus'])->name('chat.typingStatus');
    Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.view');
    Route::get('/calendar/events', [App\Http\Controllers\CalendarController::class, 'fetch']);

    Route::view('/camera-test/student', 'camera.student')->name('camera.student');
    Route::get('/camera-test/parent', [ParentDashboardController::class, 'cameraViewer'])->name('camera.parent');

    Route::post('/camera/send-signal', [CameraController::class, 'storeSignal']);
    Route::get('/camera/get-signal/{studentId}', [CameraController::class, 'getSignal']);
    Route::get('/camera/check-request/{studentId}', [CameraController::class, 'checkRequest']);

    Route::post('/camera/request/{studentId}', [CameraController::class, 'requestCamera']);

    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::middleware(['auth', 'role:1'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');

    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events', [EventController::class, 'store']);
    Route::post('/events/{id}', [EventController::class, 'update'])->name('events.update'); // Update event
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy'); // Delete event

    // Academic Year Routes
    Route::get('/academic_years', [AcademicYearController::class, 'index'])->name('academic_year.index');
    Route::get('/academic_years/sections', [AcademicYearController::class, 'showSections'])->name('academic_year.sections');
    Route::get('/academic_years/students', [AcademicYearController::class, 'showStudents'])->name('academic_year.students');
    Route::get('/academic_years/subjects', [AcademicYearController::class, 'showSubjects'])->name('academic_year.subjects');
    Route::get('/academic_years/create', [AcademicYearController::class, 'create'])->name('academic_year.create');
    Route::post('/academic_years/store', [AcademicYearController::class, 'store'])->name('academic_year.store');
    Route::get('/academic_years/edit', [AcademicYearController::class, 'edit'])->name('academic_year.edit');
    Route::put('/academic_years/update', [AcademicYearController::class, 'update'])->name('academic_year.update');
    Route::delete('/academic_years/destroy', [AcademicYearController::class, 'destroy'])->name('academic_year.destroy');

    // Grade Routes
    Route::get('/grades', [GradeController::class, 'index'])->name('grade.index');
    Route::get('/grades/create', [GradeController::class, 'create'])->name('grade.create');
    Route::post('/grades/store', [GradeController::class, 'store'])->name('grade.store');
    Route::get('/grades/edit', [GradeController::class, 'edit'])->name('grade.edit');
    Route::put('/grades/update', [GradeController::class, 'update'])->name('grade.update');
    Route::delete('/grades/destroy', [GradeController::class, 'destroy'])->name('grade.destroy');

    // Application Routes
    Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::get('/applications/edit', [ApplicationController::class, 'edit'])->name('application.edit');
    Route::put('/applications/update', [ApplicationController::class, 'update'])->name('application.update');
    Route::delete('/applications/destroy', [ApplicationController::class, 'destroy'])->name('application.destroy');
    Route::patch('/application/{id}/update-status/{status}', [ApplicationController::class, 'updateStatus'])->name('application.updateStatus');

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');
        Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teacher.create');
        Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teacher.store');
        Route::get('/teachers/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
        Route::put('/teachers/update', [TeacherController::class, 'update'])->name('teacher.update');
        Route::delete('/teachers/destroy', [TeacherController::class, 'destroy'])->name('teacher.destroy');
        Route::post('/assign-teacher', [SubjectController::class, 'assignTeacher'])->name('assign.teacher');
        Route::post('/teachers/update-status/{id}', [TeacherController::class, 'updateStatus']);
    });
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/{student}/grades/{section}', [StudentController::class, 'adminViewGrades'])->name('admin.student.viewGrades');
    Route::get('/student/{student}/attendance/{section}', [StudentController::class, 'adminViewAttendance'])->name('admin.student.viewAttendance');

    Route::get('/student/{student}/grades/{section}/subject/{subject}', [StudentController::class, 'adminFilterGradesBySubject'])->name('admin.student.filterGrades');
    Route::get('/student/{student}/attendance/{section}/subject/{subject}', [StudentController::class, 'adminFilterAttendanceBySubject'])->name('admin.student.filterAttendance');

    // Teacher dashboard route
    Route::middleware(['auth', 'role:2'])->group(function () {
        Route::get('/teacher/dashboard', [TeacherController::class, 'showDashboard'])->name('teacherdash.dashboard');

        Route::get('/teacher/classes', [TeacherController::class, 'showClasses'])->name('teacherdash.classes');
        Route::get('/teacher/exams/section/{sectionId}', [ExamController::class, 'viewBySection'])
            ->name('teacher.exams.bySection');


    // Upload exam document
    Route::post('/teacher/exams/upload/{exam}', [ExamController::class, 'uploadDocument'])->name('teacher.exams.upload');
    Route::get('/teacher/exams/grades/{exam}', [ExamController::class, 'gradesForm'])->name('teacherdash.exams.grades.form');
    Route::post('/teacher/exams/grades/{exam}', [ExamController::class, 'submitGrades'])->name('teacherdash.exams.grades.submit');
    Route::get('/teacher/attendance/calendar', [AttendanceController::class, 'calendar'])->name('attendance.calendar');
    Route::get('/teacher/attendance/events', [AttendanceController::class, 'events'])->name('attendance.events');
    Route::get('/teacher/attendance/students', [AttendanceController::class, 'getStudents'])->name('attendance.students');
    Route::post('/teacher/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');



    Route::get('/students/export/{sectionId}', function ($sectionId) {
        // Fetch the section based on the sectionId and pass it to the export
        return Excel::download(new StudentsExport($sectionId), 'students.xlsx');
    })->name('students.export');
    Route::post('/lessons/store', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/lessons/{sectionId}', [LessonController::class, 'showLessonsBySection'])
        ->name('lessons.bySection');
       
});
    Route::middleware(['auth', 'role:3'])->group(function () {
    // Student dashboard route
    Route::get('/student/dashboard', [StudentController::class, 'showDashboard'])->name('studentdash.dashboard');
    Route::get('/student/classes', [StudentController::class, 'showClasses'])->name('studentdash.classes');
    Route::get('/student/activeclass', [StudentController::class, 'showActiveClass'])->name('studentdash.activeclass');
    Route::post('/lessons', [LessonController::class, 'showLessonsBySubject'])
        ->name('lessons.bySubject');
    Route::match(['get', 'post'], '/translate-to-braille', [BrailleController::class, 'translate'])->name('translate-to-braille');
    Route::post('/signs/save', [SignController::class, 'store'])->middleware('auth');
    Route::get('/signs/load', [SignController::class, 'load'])->middleware('auth');
    Route::get('/student/grades/{section}', [StudentController::class, 'viewGrades'])->name('studentdash.viewGrades');
    Route::get('/student/attendance/{section}', [StudentController::class, 'attendanceCalendar'])->name('student.attendance.calendar');
    Route::get('/student/attendance/events/{section}', [StudentController::class, 'attendanceEvents'])->name('student.attendance.events');
    });
    Route::get('/nonverbal', function () {
        return view('studentdash.nonverbal');
    })->name('studentdash.nonverbal');

    Route::middleware(['auth', 'role:4'])->group(function () {
        Route::get('/parent/dashboard', [ParentDashboardController::class, 'index'])->middleware(['auth'])->name('parentdash.dashboard');
  Route::get('/parent/classes', [ParentDashboardController::class, 'classesPage'])->name('parentdash.classes');
    Route::get('/parent/classes/{studentId}', [ParentDashboardController::class, 'fetchStudentClasses'])->name('parentdash.classes.fetch');
        Route::post('/parent/subject-info', [ParentDashboardController::class, 'getSubjectInfo']);
    });
    Route::get('/parent/report-card/{student}/{section}', [ParentDashboardController::class, 'generateReportCard'])->name('parentdash.reportCard');
    Route::get('/parent/report-card/{student}/{section}/download', [ParentDashboardController::class, 'downloadReportCardPdf'])->name('parentdash.reportCard.download');
    Route::post('/parent/enroll-next/{student}/{currentSection}', [ParentDashboardController::class, 'enrollToNextGrade']);
});
