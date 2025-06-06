<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_id',
        'status',
    ];

    // Defining the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Defining the relationship with the Application model
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    // Defining the many-to-many relationship with the Section model
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_student')
                    ->withPivot('academic_year_id','status')
                    ->withTimestamps();
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_student_grades', 'student_id', 'exam_id')
            ->withPivot('grade')
            ->withTimestamps();
    }
    public function parent()
    {
        return $this->belongsTo(StudentParent::class, 'parent_id');
    }
    public function activeSection()
    {
        return $this->sections()
            ->whereHas('academicYear', function ($q) {
                $q->where('status', 'pending');
            })
            ->with('grade', 'academicYear') // eager load for display
            ->first();
    }
    public function previousSections()
    {
        return $this->sections()
            ->whereHas('academicYear', function ($query) {
                $query->where('status', '!=', 'pending'); // Or 'status' = 'completed'
            })
            ->with('grade', 'academicYear');
    }
    public function examGrades()
    {
        return $this->hasMany(ExamStudentGrade::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}