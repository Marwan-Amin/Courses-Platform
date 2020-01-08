<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSupporterCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_supporter_course', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('teacher_id');
            $table->foreign('teacher_id')->references('Nid')->on('users');

            $table->string('supporter_id');
            $table->foreign('supporter_id')->references('Nid')->on('users');

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
        Schema::dropIfExists('teacher_supporter_course');
    }
}
