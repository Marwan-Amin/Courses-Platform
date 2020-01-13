<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentCourseStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_course_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('body');
            $table->integer('approver_id');
            $table->integer('course_id');
            $table->integer('student_id');	
            $table->tinyInteger('is_aapproved')->default(0);	
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
        Schema::dropIfExists('comment_course_student');
    }
}
