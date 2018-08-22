<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->string('exam_type')->nullable();
            $table->string('exam_center')->nullable();
            $table->string('exam_no')->nullable();
            $table->string('exam_date')->nullable();
            $table->text('grade')->nullable();
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')
					->references('id')->on('users')
					->onDelete('cascade');
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
        Schema::dropIfExists('results');
    }
}
