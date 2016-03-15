<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotThemePrevThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_prev_theme', function (Blueprint $table) {
            $table->unsignedSmallInteger('theme_id')->index();
            $table->unsignedSmallInteger('prev_theme_id')->index();

            $table->timestamps();

            $table->foreign('theme_id')
                ->references('id')
                ->on('themes')
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
        Schema::drop('theme_prev_theme');
    }
}
