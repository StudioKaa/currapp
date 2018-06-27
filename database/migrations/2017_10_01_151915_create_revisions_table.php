<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->integer('status')->unsigned();
            $table->string('author_id');
            $table->integer('type')->unsigned();
            $table->text('wv_title')->nullable();
            $table->text('wv_path')->nullable();
            $table->text('tv_title')->nullable();
            $table->text('tv_path')->nullable();
            $table->text('sv_title')->nullable();
            $table->text('sv_path')->nullable();
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
        Schema::dropIfExists('revisions');
    }
}
