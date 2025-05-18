<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Carbon\Carbon;
use App\Models\Teacher;
use App\Models\SectionSubjectTeacher;
use App\Models\Application;
use App\Models\Section;
use App\Models\AcademicYear;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pass the user's role to the view
        return view('dashboard', compact('user'));
    // Removed incorrect use statement
    }
    public function __invoke()
    {
        $sectionsSubjects = SectionSubjectTeacher::with(['section', 'subject', 'teacher'])->get();
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $pendingApplicationCount = Application::where('status', 'pending')->count();

        $openSectionCount = Section::whereHas('academicYear', function ($query) {
            $query->where('status', 'pending');
        })->count();

        $academicYear = AcademicYear::where('status', 'pending')->first();

        $academicYearProgress = 0;
        if ($academicYear) {
            $start = Carbon::parse($academicYear->start_date);
            $end = Carbon::parse($academicYear->end_date);
            $now = Carbon::now();

            if ($now->lt($start)) {
                $academicYearProgress = 0;
            } elseif ($now->gt($end)) {
                $academicYearProgress = 100;
            } else {
                $totalDays = max($start->diffInDays($end), 1);
                $daysPassed = $start->diffInDays($now);
                $academicYearProgress = round(($daysPassed / $totalDays) * 100);
            }
        }
        $sectionCapacities = Section::withCount('students') // or the correct relationship name
            ->whereHas('academicYear', function ($query) {
                $query->where('status', 'pending');
            })
            ->with('grade') // assuming each section belongs to a grade
            ->get()
            ->map(function ($section) {
                return [
                    'name' => $section->grade->name . ' - ' . $section->name,
                    'capacity' => $section->capacity ?? 30, // fallback to 30 if capacity is null
                    'students' => $section->students_count,
                ];
            });
        return view('dashboard', compact(
            'studentCount',
            'teacherCount',
            'sectionsSubjects',
            'pendingApplicationCount',
            'openSectionCount',
            'academicYearProgress',
            'academicYear',
            'sectionCapacities'
        ));
    }
}