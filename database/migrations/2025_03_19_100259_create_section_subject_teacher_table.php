<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('section_subject_teacher', function (Blueprint $table) {
$table->id();
$table->foreignId('section_id')->constrained()->onDelete('cascade');
$table->foreignId('subject_id')->constrained()->onDelete('cascade');
$table->foreignId('teacher_id')->constrained()->onDelete('cascade');
$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('section_subject_teacher');
}
};