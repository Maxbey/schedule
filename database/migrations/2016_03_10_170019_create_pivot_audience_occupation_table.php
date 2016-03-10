<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotAudienceOccupationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audience_occupation', function (Blueprint $table) {
            $table->unsignedTinyInteger('audience_id');
            $table->unsignedInteger('occupation_id');

            $table->timestamps();

            $table->foreign('audience_id')
                ->references('id')
                ->on('audiences')
                ->onDelete('cascade');

            $table->foreign('occupation_id')
                ->references('id')
                ->on('occupations')
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
        Schema::drop('audience_occupation');
    }
}
