<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->string('author_id');
            $table->string('title');
            $table->string('link');
            $table->string('visibility')->default('teacher');
            $table->timestamps();

            $table->foreign('lesson_id')
                    ->references('id')->on('lessons')
                    ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
