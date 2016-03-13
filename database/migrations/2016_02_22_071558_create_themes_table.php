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
            $table->smallInteger('term');
            $table->unsignedTinyInteger('prev_theme_id')->nullable()->index();
            $table->smallInteger('discipline_id')->unsigned()->index();
            $table->unsignedTinyInteger('audiences_count');
            $table->unsignedTinyInteger('teachers_count');
            $table->unsignedTinyInteger('duration');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines')
                ->onDelete('cascade');

            $table->foreign('prev_theme_id')
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
        Schema::drop('themes');
    }
}
