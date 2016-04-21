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
            $table->unsignedTinyInteger('initial_hour');

            $table->smallInteger('troop_id')->unsigned()->index();
            $table->integer('theme_id')->unsigned()->index();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('troop_id')
                ->references('id')
                ->on('troops')
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
