<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('middlename', 100);
            $table->string('military_rank', 100);
            $table->string('slug')->nullable();

            $table->mediumInteger('work_hours_limit');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('teachers');
    }
}
