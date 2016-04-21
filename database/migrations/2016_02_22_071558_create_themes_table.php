<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 100);
            $table->string('number');
            $table->unsignedTinyInteger('term');

            $table->boolean('self_study');
            $table->unsignedTinyInteger('duration');
            $table->unsignedTinyInteger('audiences_count');
            $table->unsignedTinyInteger('teachers_count');

            $table->unsignedSmallInteger('discipline_id')->index();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines')
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
        Schema::drop('themes');
    }
}
