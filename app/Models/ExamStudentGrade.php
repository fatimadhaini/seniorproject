<?php

// App\Models\ExamStudentGrade.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamStudentGrade extends Model
{
    protected $table = 'exam_student_grades';

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
