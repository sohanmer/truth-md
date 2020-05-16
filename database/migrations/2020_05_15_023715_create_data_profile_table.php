<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('license')->nullable();
            $table->longText('content')->nullable();
            $table->string('address')->nullable();
            $table->string('speciality')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->string('in_progress')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_profile');
    }
}
