<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccupationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date_of');
            $table->smallInteger('teacher_id')->unsigned()->index();
            $table->smallInteger('troop_id')->unsigned()->index();
            $table->integer('theme_id')->unsigned()->index();
            $table->smallInteger('discipline_id')->unsigned()->index();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onDelete('cascade');

            $table->foreign('troop_id')
                ->references('id')
                ->on('troops')
                ->onDelete('cascade');

            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines')
                ->onDelete('cascade');

            $table->foreign('theme_id')
                ->references('id')
                ->on('themes')
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
        Schema::drop('occupations');
    }
}
