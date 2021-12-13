<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mcqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exam_id');
            $table->string('questionName',255);
            $table->text('questionDescription', 500)->nullable();
            $table->string('optionOne',255);
            $table->string('optionTwo',255);
            $table->string('optionThree',255);
            $table->string('optionFour',255);
            $table->string('answer',255)->nullable();
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
        //
    }
}
