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
            $table->string('author_id');
            $table->integer('type');
            $table->string('reviewer_id')->nullable();
            $table->text('wv_filename')->nullable();
            $table->text('wv_do_path')->nullable();
            $table->text('tv_filename')->nullable();
            $table->text('tv_do_path')->nullable();
            $table->text('sv_filename')->nullable();
            $table->text('sv_do_path')->nullable();
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
