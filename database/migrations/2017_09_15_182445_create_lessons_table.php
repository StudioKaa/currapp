l <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_type_id')->unsigned();
            $table->integer('week_start');
            $table->integer('duration');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('lesson_type_id')
                    ->references('id')->on('lesson_types')
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
        Schema::dropIfExists('lessons');
    }
}
