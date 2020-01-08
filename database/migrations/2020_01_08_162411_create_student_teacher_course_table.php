<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTeacherCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_teacher_course', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            $table->string('teacher_id');
            $table->foreign('teacher_id')->references('Nid')->on('users');

            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_teacher_course');
    }
}
