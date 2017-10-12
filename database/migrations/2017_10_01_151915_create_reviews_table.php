<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->integer('review_status_id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->integer('reviewer_id')->unsigned()->nullable();
            $table->string('wv_filename')->nullable();
            $table->string('wv_do_path')->nullable();
            $table->string('tv_filename')->nullable();
            $table->string('tv_do_path')->nullable();
            $table->string('sv_filename')->nullable();
            $table->string('sv_do_path')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
