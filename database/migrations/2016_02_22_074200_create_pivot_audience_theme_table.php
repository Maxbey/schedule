<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotAudienceThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audience_theme', function (Blueprint $table) {
            $table->smallInteger('audience_id')->unsigned()->index();
            $table->integer('theme_id')->unsigned()->index();

            $table->timestamps();

            $table->foreign('audience_id')
                ->references('id')
                ->on('audiences')
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
        Schema::drop('audience_theme');
    }
}
