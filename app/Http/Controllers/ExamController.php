<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class ExamController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'audience' => 'required|array',
            'section_subject_teacher_id' => 'required|exists:section_subject_teacher,id',
        ]);

        // Step 1: Create Event
        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'audience' => json_encode($request->audience),
        ]);

        // Step 2: Create Exam
        $exam = Exam::create([
            'event_id' => $event->id,
            'section_subject_teacher_id' => $request->section_subject_teacher_id,
        ]);

        // Step 3: Attach students
        $section = $exam->sectionSubjectTeacher->section;
        $students = $section ? $section->students : collect();

        if ($students->isNotEmpty()) {
            $exam->students()->syncWithoutDetaching(
                $students->pluck('id')->mapWithKeys(function ($id) {
                    return [$id => ['grade' => null]];
                })->toArray()
            );
        }

        // ✅ Step 4: Push Notifications

        // Send to Teacher: Upload exam document reminder
        Notification::create([
            'title' => 'New Exam Created',
            'message' => 'Please upload the document for: ' . $request->title,
            'audience' => json_encode(['teachers']),
        ]);

        // Send to Students: Upcoming exam notification
        Notification::create([
            'title' => 'Upcoming Exam: ' . $request->title,
            'message' => 'You have an exam scheduled on ' . \Carbon\Carbon::parse($request->start)->format('d M Y, h:i A'),
            'audience' => json_encode(['students']),
        ]);

        return response()->json([
            'message' => 'Exam, Event, and Notifications created successfully!',
        ]);
    }


    public function teacherExams()
    {
        $teacherId = Auth::user()->teacher->id; // current logged-in teacher

        $exams = Exam::whereHas('sectionSubjectTeacher', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->with(['event', 'sectionSubjectTeacher.section', 'sectionSubjectTeacher.subject'])->get();

        return view('teacherdash.exams.index', compact('exams'));
    }



    public function uploadDocument(Request $request, Exam $exam)
    {
        $request->validate([
            'exam_document' => 'required|file|mimes:pdf,doc,docx|max:10240', // 10 MB
        ]);

        // ✅ Check if current time is BEFORE exam start
        if (now()->greaterThan($exam->event->start)) {
            return response()->json([
                'message' => 'Upload deadline has passed. You cannot upload after the exam start time.'
            ], 422);
        }

        // ✅ Save document to storage/app/public/exam_documents
        $path = $request->file('exam_document')->store('exam_documents', 'public');

        $exam->update([
            'exam_document_path' => $path,
        ]);

        return response()->json([
            'message' => 'Exam document uploaded successfully!',
        ]);
    }

    public function gradesForm(Exam $exam)
    {
        $exam->load('event', 'sectionSubjectTeacher.subject', 'sectionSubjectTeacher.section.grade');

        // ✅ Load students specifically from the exam pivot, not from the section
        $students = $exam->students()->with('application')->get();

        return view('teacherdash.exams.grades', compact('exam', 'students'));
    }


    public function submitGrades(Request $request, Exam $exam)
    {
        $request->validate([
            'grades' => 'required|array',
        ]);

        foreach ($request->grades as $studentId => $grade) {
            DB::table('exam_student_grades')->updateOrInsert(
                ['exam_id' => $exam->id, 'student_id' => $studentId],
                ['grade' => $grade, 'updated_at' => now()]
            );
        }

        $exam->update(['has_grades' => true]);

        return redirect()->route('teacherdash.exams.grades.form', $exam->id)
            ->with('success', 'Grades submitted successfully!');
    }
    public function viewBySection($sectionId)
    {

        $teacherId = Auth::user()->teacher->id; // current logged-in teacher
        $exams = Exam::whereHas('sectionSubjectTeacher', function ($query) use ($sectionId, $teacherId) {
            $query->where('section_id', $sectionId)
                ->where('teacher_id', $teacherId);
        })->with(['sectionSubjectTeacher.section.grade', 'sectionSubjectTeacher.subject', 'event'])->get();

        return view('teacherdash.exams.index', compact('exams'));
    }
}
